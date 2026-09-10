<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $quotations = Quotation::with('client')
            ->when($request->search, function ($query, $search) {
                $query->where('quotario_number', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();

        return view('quotations.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => [
                'required',
                'integer',
                'exists:clients,id',
            ],

            'valid_until' => [
                'required',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.unit' => [
                'required',
                'string',
                'max:50',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        DB::transaction(function () use ($validated, &$quotation) {

            /*
            |--------------------------------------------------------------------------
            | GENERATE QUOTATION NUMBER
            |--------------------------------------------------------------------------
            */

            $lastQuotation = Quotation::latest('id')->first();

            $nextNumber = $lastQuotation
                ? $lastQuotation->id + 1
                : 1;

            $quotationNumber =
                'QT-' . str_pad(
                    $nextNumber,
                    4,
                    '0',
                    STR_PAD_LEFT
                );


            /*
            |--------------------------------------------------------------------------
            | CALCULATE TOTALS
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($validated['items'] as $item) {

                $quantity = (float) $item['quantity'];

                $unitPrice = (float) $item['unit_price'];

                $amount = $quantity * $unitPrice;

                $subtotal += $amount;
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE QUOTATION
            |--------------------------------------------------------------------------
            */

            $quotation = Quotation::create([

                'quotario_number' => $quotationNumber,

                'client_id' => $validated['client_id'],

                'valid_until' => $validated['valid_until'],

                'status' => false,

                'subtotal' => $subtotal,

                'tax' => 0,

                'total_amount' => $subtotal,

                'notes' => $validated['notes'] ?? null,

                'user_id' => auth()->id(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | CREATE QUOTATION ITEMS
            |--------------------------------------------------------------------------
            */

            foreach ($validated['items'] as $item) {

                $quantity =
                    (float) $item['quantity'];

                $unitPrice =
                    (float) $item['unit_price'];

                $amount =
                    $quantity * $unitPrice;


                $quotation->items()->create([

                    'description' =>
                        $item['description'],

                    'quantity' =>
                        $quantity,

                    'unit_price' =>
                        $unitPrice,

                    'unit' =>
                        $item['unit'],

                    'amount' =>
                        $amount,

                    'tax_rate' =>
                        0,

                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('quotations.index')
            ->with(
                'success',
                'Quotation created successfully.'
            );
    }

    public function show(Quotation $quotation)
    {
        $quotation->load([
            'client',
            'items',
            'user',
        ]);

        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $clients = Client::orderBy('name')->get();

        $quotation->load('items');

        return view(
            'quotations.edit',
            compact('quotation', 'clients')
        );
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'client_id' => [
                'required',
                'exists:clients,id',
            ],

            'valid_until' => [
                'required',
                'date',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        DB::transaction(function () use ($validated, $quotation) {

            $subtotal = 0;

            foreach ($validated['items'] as $item) {
                $subtotal +=
                    $item['quantity'] *
                    $item['unit_price'];
            }

            $tax = $validated['tax'] ?? 0;

            $total = $subtotal + $tax;

            $quotation->update([
                'client_id' => $validated['client_id'],
                'valid_until' => $validated['valid_until'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $total,
                'notes' => $validated['notes'] ?? null,
            ]);

            $quotation->items()->delete();

            foreach ($validated['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $quotation->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $amount,
                ]);
            }
        });

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
}
