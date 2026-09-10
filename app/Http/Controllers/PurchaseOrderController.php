<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    /**
     * Display all purchase orders.
     */
    public function index(): View
    {
        $purchaseOrders = PurchaseOrder::with([
            'quotation.client',
            'uploader',
        ])
            ->latest()
            ->paginate(10);

        return view('purchase_orders.index', compact('purchaseOrders'));
    }

    /**
     * Show the create form.
     */
    public function create(Quotation $quotation): View
    {
        $quotation->load([
            'client',
            'items',
        ]);

        return view('purchase_orders.create', compact('quotation'));
    }

    /**
     * Store a new purchase order.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quotation_id' => [
                'required',
                'exists:quotations,id',
            ],

            'po_number' => [
                'required',
                'string',
                'max:100',
            ],

            'po_date' => [
                'nullable',
                'date',
            ],

            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
                'max:10240',
            ],
        ]);

        $purchaseOrder = DB::transaction(function () use ($request, $validated) {

            // =====================================================
            // GET QUOTATION
            // =====================================================

            $quotation = Quotation::findOrFail(
                $validated['quotation_id']
            );

            // =====================================================
            // UPLOAD FILE
            // =====================================================

            $file = $request->file('file');

            $path = $file->store(
                'purchase-orders',
                'public'
            );

            // =====================================================
            // CREATE PURCHASE ORDER
            // =====================================================

            $purchaseOrder = PurchaseOrder::create([
                'quotation_id' => $quotation->id,
                'po_number' => $validated['po_number'],
                'po_date' => $validated['po_date'] ?? null,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'uploaded_by' => auth()->id(),
            ]);


            $quotation->status = 1;
            $quotation->save();

            return $purchaseOrder;
        });

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order uploaded successfully.'
            );
    }
    /**
     * Display a purchase order.
     */
    public function show(PurchaseOrder $purchaseOrder): View
    {
        $purchaseOrder->load([
            'quotation.client',
            'quotation.items',
            'uploader',
        ]);

        return view(
            'purchase_orders.show',
            compact('purchaseOrder')
        );
    }

    /**
     * Download the uploaded file.
     */
    public function download(PurchaseOrder $purchaseOrder)
    {
        if (!Storage::disk('public')->exists($purchaseOrder->file_path)) {
            abort(404, 'Purchase Order file not found.');
        }

        return Storage::disk('public')->download(
            $purchaseOrder->file_path,
            $purchaseOrder->file_name
        );
    }

    /**
     * Delete a purchase order.
     */
    public function destroy(
        PurchaseOrder $purchaseOrder
    ): RedirectResponse {
        Storage::disk('public')->delete(
            $purchaseOrder->file_path
        );

        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Purchase Order deleted successfully.');
    }
}
