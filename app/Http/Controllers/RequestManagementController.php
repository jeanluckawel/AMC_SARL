<?php

namespace App\Http\Controllers;

use App\Enums\RequestDecision;
use App\Enums\RequestStatus;
use App\Enums\RequestStep;
use App\Enums\RequestStep as RequestStepEnum;
use App\Models\RequestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RequestManagementController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $query = RequestModel::with([
            'requester',
            'items',
            'attachments',
            'steps.user',
        ]);

        if ($user->hasRole('Requester')) {

            $query->where('requester_id', $user->id);

        } elseif ($user->hasRole('Procurement')) {

            $query->where(
                'status',
                RequestStatus::PENDING_PROCUREMENT
            );

        } elseif ($user->hasRole('Finance')) {

            $query->where(
                'status',
                RequestStatus::PENDING_FINANCE
            );

        } elseif ($user->hasRole('CEO')) {

            $query->where(
                'status',
                RequestStatus::PENDING_CEO
            );

        } elseif (
            $user->hasRole('Admin') ||
            $user->hasRole('IT')
        ) {


        } else {

            $query->where('requester_id', $user->id);
        }

        $requests = $query
            ->latest('created_at')
            ->get();

        return view(
            'requests.index',
            compact('requests')
        );
    }


    public function create(): View
    {
        return view('requests.create');
    }
//
//    public function store(
//        HttpRequest $request
//    ): RedirectResponse {
//
//        $validated = $request->validate([
//
//            'title' => [
//                'required',
//                'string',
//                'max:255',
//            ],
//
//            'description' => [
//                'nullable',
//                'string',
//            ],
//
//            'items' => [
//                'required',
//                'array',
//                'min:1',
//            ],
//
//            'items.*.name' => [
//                'required',
//                'string',
//                'max:255',
//            ],
//
//            'items.*.quantity' => [
//                'required',
//                'numeric',
//                'min:0.01',
//            ],
//
//            'items.*.unit' => [
//                'nullable',
//                'string',
//                'max:100',
//            ],
//
//            'items.*.description' => [
//                'nullable',
//                'string',
//            ],
//
//            'attachments' => [
//                'nullable',
//                'array',
//            ],
//
//            'attachments.*' => [
//                'file',
//                'max:10240',
//            ],
//        ]);
//
//        $requestModel = DB::transaction(
//            function () use (
//                $validated,
//                $request
//            ) {
//
//
//                $requestModel = RequestModel::create([
//                    'requester_id' => auth()->id(),
//
//                    'reference' => 'TEMP-' . uniqid(),
//
//                    'title' =>
//                        $validated['title'],
//
//                    'description' =>
//                        $validated['description'] ?? null,
//
//                    'total_amount' => 0,
//
//                    'status' =>
//                        RequestStatus::PENDING_PROCUREMENT,
//                ]);
//
//                $requestModel->update([
//                    'reference' =>
//                        'REQ-' .
//                        now()->format('Ymd') .
//                        '-' .
//                        str_pad(
//                            (string) $requestModel->id,
//                            6,
//                            '0',
//                            STR_PAD_LEFT
//                        ),
//                ]);
//
//                foreach (
//                    $validated['items']
//                    as $item
//                ) {
//
//                    $requestModel->items()->create([
//                        'name' =>
//                            $item['name'],
//
//                        'quantity' =>
//                            $item['quantity'],
//
//                        'unit' =>
//                            $item['unit'] ?? null,
//
//                        'description' =>
//                            $item['description'] ?? null,
//
//                        /*
//                        |--------------------------------------------------------------------------
//                        | Champs Procurement
//                        |--------------------------------------------------------------------------
//                        */
//
//                        'unit_price' => null,
//
//                        'total_price' => null,
//
//                        'supplier' => null,
//
//                        'supplier_reference' => null,
//
//                        'procurement_note' => null,
//                    ]);
//                }
//
//                /*
//                |--------------------------------------------------------------------------
//                | Pièces jointes
//                |--------------------------------------------------------------------------
//                */
//
//                if ($request->hasFile('attachments')) {
//
//                    foreach (
//                        $request->file('attachments')
//                        as $file
//                    ) {
//
//                        $path = $file->store(
//                            'requests/' .
//                            $requestModel->id,
//                            'public'
//                        );
//
//                        $requestModel->attachments()->create([
//                            'uploaded_by' =>
//                                auth()->id(),
//
//                            'original_name' =>
//                                $file->getClientOriginalName(),
//
//                            'file_name' =>
//                                basename($path),
//
//                            'file_path' =>
//                                $path,
//
//                            'disk' =>
//                                'public',
//
//                            'mime_type' =>
//                                $file->getMimeType(),
//
//                            'file_size' =>
//                                $file->getSize(),
//                        ]);
//                    }
//                }
//
//                return $requestModel;
//            }
//        );
//
//        return redirect()
//            ->route(
//                'requests.show',
//                $requestModel
//            )
//            ->with(
//                'success',
//                'La demande a été créée avec succès.'
//            );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | SHOW
//    |--------------------------------------------------------------------------
//    */
//
//    public function show(
//        RequestModel $requestModel
//    ): View {
//
//        $requestModel->load([
//            'requester',
//            'items',
//            'attachments.uploader',
//            'steps.user',
//        ]);
//
//        $this->authorizeView(
//            $requestModel
//        );
//
//        return view(
//            'requests.show',
//            compact('requestModel')
//        );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | PROCUREMENT - APPROVE / PROCESS
//    |--------------------------------------------------------------------------
//    |
//    | Procurement complète :
//    | - prix unitaire
//    | - fournisseur
//    | - référence fournisseur
//    | - note
//    |
//    | Puis la demande passe à Finance.
//    |
//    */
//
//    public function procurementProcess(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('Procurement');
//
//        $this->ensureStatus(
//            $requestModel,
//            RequestStatus::PENDING_PROCUREMENT
//        );
//
//        $validated = $request->validate([
//
//            'items' => [
//                'required',
//                'array',
//                'min:1',
//            ],
//
//            'items.*.unit_price' => [
//                'required',
//                'numeric',
//                'min:0',
//            ],
//
//            'items.*.supplier' => [
//                'nullable',
//                'string',
//                'max:255',
//            ],
//
//            'items.*.supplier_reference' => [
//                'nullable',
//                'string',
//                'max:255',
//            ],
//
//            'items.*.procurement_note' => [
//                'nullable',
//                'string',
//            ],
//
//            'comment' => [
//                'nullable',
//                'string',
//            ],
//        ]);
//
//        DB::transaction(
//            function () use (
//                $validated,
//                $requestModel
//            ) {
//
//                $totalAmount = 0;
//
//                /*
//                |--------------------------------------------------------------------------
//                | Traitement des articles
//                |--------------------------------------------------------------------------
//                */
//
//                foreach (
//                    $requestModel->items
//                    as $item
//                ) {
//
//                    $data =
//                        $validated['items']
//                        [$item->id]
//                        ?? null;
//
//                    if (!$data) {
//
//                        abort(
//                            422,
//                            'Article manquant.'
//                        );
//                    }
//
//                    $unitPrice =
//                        (float) $data['unit_price'];
//
//                    $quantity =
//                        (float) $item->quantity;
//
//                    $totalPrice =
//                        $quantity * $unitPrice;
//
//                    $item->update([
//                        'unit_price' =>
//                            $unitPrice,
//
//                        'total_price' =>
//                            $totalPrice,
//
//                        'supplier' =>
//                            $data['supplier']
//                            ?? null,
//
//                        'supplier_reference' =>
//                            $data['supplier_reference']
//                            ?? null,
//
//                        'procurement_note' =>
//                            $data['procurement_note']
//                            ?? null,
//                    ]);
//
//                    $totalAmount += $totalPrice;
//                }
//
//                /*
//                |--------------------------------------------------------------------------
//                | Mise à jour demande
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->update([
//                    'total_amount' =>
//                        $totalAmount,
//
//                    'status' =>
//                        RequestStatus::PENDING_FINANCE,
//                ]);
//
//                /*
//                |--------------------------------------------------------------------------
//                | Enregistrement étape Procurement
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->steps()->create([
//                    'user_id' =>
//                        auth()->id(),
//
//                    'step' =>
//                        RequestStepEnum::PROCUREMENT,
//
//                    'decision' =>
//                        RequestDecision::APPROVED,
//
//                    'comment' =>
//                        $validated['comment']
//                        ?? null,
//
//                    'processed_at' =>
//                        now(),
//                ]);
//            }
//        );
//
//        return redirect()
//            ->route(
//                'requests.show',
//                $requestModel
//            )
//            ->with(
//                'success',
//                'La demande a été envoyée à Finance.'
//            );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | PROCUREMENT - REJECT
//    |--------------------------------------------------------------------------
//    */
//
//    public function procurementReject(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('Procurement');
//
//        return $this->rejectRequest(
//            $request,
//            $requestModel,
//            RequestStepEnum::PROCUREMENT,
//            RequestStatus::PENDING_PROCUREMENT
//        );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | FINANCE - APPROVE
//    |--------------------------------------------------------------------------
//    */
//
//    public function financeApprove(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('Finance');
//
//        $this->ensureStatus(
//            $requestModel,
//            RequestStatus::PENDING_FINANCE
//        );
//
//        $validated = $request->validate([
//            'comment' => [
//                'nullable',
//                'string',
//            ],
//        ]);
//
//        DB::transaction(
//            function () use (
//                $validated,
//                $requestModel
//            ) {
//
//                /*
//                |--------------------------------------------------------------------------
//                | Passage au CEO
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->update([
//                    'status' =>
//                        RequestStatus::PENDING_CEO,
//                ]);
//
//                /*
//                |--------------------------------------------------------------------------
//                | Historique Finance
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->steps()->create([
//                    'user_id' =>
//                        auth()->id(),
//
//                    'step' =>
//                        RequestStepEnum::FINANCE,
//
//                    'decision' =>
//                        RequestDecision::APPROVED,
//
//                    'comment' =>
//                        $validated['comment']
//                        ?? null,
//
//                    'processed_at' =>
//                        now(),
//                ]);
//            }
//        );
//
//        return redirect()
//            ->route(
//                'requests.show',
//                $requestModel
//            )
//            ->with(
//                'success',
//                'La demande a été envoyée au CEO.'
//            );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | FINANCE - REJECT
//    |--------------------------------------------------------------------------
//    */
//
//    public function financeReject(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('Finance');
//
//        return $this->rejectRequest(
//            $request,
//            $requestModel,
//            RequestStepEnum::FINANCE,
//            RequestStatus::PENDING_FINANCE
//        );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | CEO - APPROVE
//    |--------------------------------------------------------------------------
//    */
//
//    public function ceoApprove(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('CEO');
//
//        $this->ensureStatus(
//            $requestModel,
//            RequestStatus::PENDING_CEO
//        );
//
//        $validated = $request->validate([
//            'comment' => [
//                'nullable',
//                'string',
//            ],
//        ]);
//
//        DB::transaction(
//            function () use (
//                $validated,
//                $requestModel
//            ) {
//
//                /*
//                |--------------------------------------------------------------------------
//                | Approbation définitive
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->update([
//                    'status' =>
//                        RequestStatus::APPROVED,
//
//                    'approved_at' =>
//                        now(),
//                ]);
//
//                /*
//                |--------------------------------------------------------------------------
//                | Historique CEO
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->steps()->create([
//                    'user_id' =>
//                        auth()->id(),
//
//                    'step' =>
//                        RequestStepEnum::CEO,
//
//                    'decision' =>
//                        RequestDecision::APPROVED,
//
//                    'comment' =>
//                        $validated['comment']
//                        ?? null,
//
//                    'processed_at' =>
//                        now(),
//                ]);
//            }
//        );
//
//        return redirect()
//            ->route(
//                'requests.show',
//                $requestModel
//            )
//            ->with(
//                'success',
//                'La demande a été approuvée définitivement.'
//            );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | CEO - REJECT
//    |--------------------------------------------------------------------------
//    */
//
//    public function ceoReject(
//        HttpRequest $request,
//        RequestModel $requestModel
//    ): RedirectResponse {
//
//        $this->ensureRole('CEO');
//
//        return $this->rejectRequest(
//            $request,
//            $requestModel,
//            RequestStepEnum::CEO,
//            RequestStatus::PENDING_CEO
//        );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | REJECT REQUEST
//    |--------------------------------------------------------------------------
//    |
//    | Méthode commune pour Procurement, Finance et CEO.
//    |
//    */
//
//    private function rejectRequest(
//        HttpRequest $request,
//        RequestModel $requestModel,
//        RequestStepEnum $step,
//        RequestStatus $expectedStatus
//    ): RedirectResponse {
//
//        $this->ensureStatus(
//            $requestModel,
//            $expectedStatus
//        );
//
//        $validated = $request->validate([
//            'comment' => [
//                'required',
//                'string',
//                'min:3',
//            ],
//        ]);
//
//        DB::transaction(
//            function () use (
//                $validated,
//                $requestModel,
//                $step
//            ) {
//
//                /*
//                |--------------------------------------------------------------------------
//                | Demande rejetée
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->update([
//                    'status' =>
//                        RequestStatus::REJECTED,
//
//                    'rejected_at' =>
//                        now(),
//                ]);
//
//                /*
//                |--------------------------------------------------------------------------
//                | Historique de l'étape
//                |--------------------------------------------------------------------------
//                */
//
//                $requestModel->steps()->create([
//                    'user_id' =>
//                        auth()->id(),
//
//                    'step' =>
//                        $step,
//
//                    'decision' =>
//                        RequestDecision::REJECTED,
//
//                    'comment' =>
//                        $validated['comment'],
//
//                    'processed_at' =>
//                        now(),
//                ]);
//            }
//        );
//
//        return redirect()
//            ->route(
//                'requests.show',
//                $requestModel
//            )
//            ->with(
//                'success',
//                'La demande a été rejetée.'
//            );
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | ENSURE STATUS
//    |--------------------------------------------------------------------------
//    */
//
//    private function ensureStatus(
//        RequestModel $requestModel,
//        RequestStatus $expectedStatus
//    ): void {
//
//        if (
//            $requestModel->status !==
//            $expectedStatus
//        ) {
//
//            abort(
//                422,
//                'Cette demande ne peut pas être traitée à cette étape.'
//            );
//        }
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | ENSURE ROLE
//    |--------------------------------------------------------------------------
//    */
//
//    private function ensureRole(
//        string $role
//    ): void {
//
//        if (
//            !auth()->user()->hasRole($role)
//        ) {
//            abort(403);
//        }
//    }
//
//    /*
//    |--------------------------------------------------------------------------
//    | AUTHORIZE VIEW
//    |--------------------------------------------------------------------------
//    */
//
//    private function authorizeView(
//        RequestModel $requestModel
//    ): void {
//
//        $user = auth()->user();
//
//        /*
//        |--------------------------------------------------------------------------
//        | ADMIN / IT
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $user->hasRole('Admin') ||
//            $user->hasRole('IT')
//        ) {
//            return;
//        }
//
//        /*
//        |--------------------------------------------------------------------------
//        | REQUESTER
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $requestModel->requester_id ===
//            $user->id
//        ) {
//            return;
//        }
//
//        /*
//        |--------------------------------------------------------------------------
//        | PROCUREMENT
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $user->hasRole('Procurement') &&
//            $requestModel->status ===
//            RequestStatus::PENDING_PROCUREMENT
//        ) {
//            return;
//        }
//
//        /*
//        |--------------------------------------------------------------------------
//        | FINANCE
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $user->hasRole('Finance') &&
//            $requestModel->status ===
//            RequestStatus::PENDING_FINANCE
//        ) {
//            return;
//        }
//
//        /*
//        |--------------------------------------------------------------------------
//        | CEO
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $user->hasRole('CEO') &&
//            $requestModel->status ===
//            RequestStatus::PENDING_CEO
//        ) {
//            return;
//        }
//
//        /*
//        |--------------------------------------------------------------------------
//        | UTILISATEUR AYANT DÉJÀ TRAITÉ
//        |--------------------------------------------------------------------------
//        */
//
//        if (
//            $requestModel->steps()
//                ->where(
//                    'user_id',
//                    $user->id
//                )
//                ->exists()
//        ) {
//            return;
//        }
//
//        abort(403);
//    }
    public function store(HttpRequest $request): RedirectResponse
    {
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'items.*.unit' => [
                'nullable',
                'string',
                'max:100',
            ],

        ]);


        $requestModel = DB::transaction(function () use ($validated) {

            /*
             * =====================================================
             * CREATE REQUEST
             * =====================================================
             */

            $requestModel = RequestModel::create([

                'requester_id' => auth()->id(),


                'reference' => 'TEMP-' . uniqid(),

                'title' => $validated['title'],

                'description' =>
                    $validated['description'] ?? null,


                'total_amount' => 0,

                'status' =>
                    RequestStatus::PENDING_PROCUREMENT,

            ]);

            $requestModel->update([

                'reference' =>
                    'REQ-' .
                    now()->format('Ymd') .
                    '-' .
                    str_pad(
                        (string)$requestModel->id,
                        6,
                        '0',
                        STR_PAD_LEFT
                    ),

            ]);


            foreach ($validated['items'] as $item) {

                $requestModel->items()->create([

                    'name' =>
                        $item['name'],

                    'quantity' =>
                        $item['quantity'],

                    'unit' =>
                        $item['unit'] ?? null,

                    /*
                     * Procurement fields remain empty.
                     */
                    'unit_price' => null,

                    'total_price' => null,

                    'supplier' => null,

                    'supplier_reference' => null,

                    'procurement_note' => null,

                ]);

            }


            return $requestModel;

        });


        return redirect()
            ->route(
                'requests.index',
                $requestModel
            )
            ->with(
                'success',
                'Request created successfully.'
            );
    }

    public function show(RequestModel $requestModel)
    {
        $requestModel->load([
            'requester',
            'items',
            'attachments.uploader',
            'steps.user',
        ]);

//        $this->authorizeView($requestModel);

        return view('requests.show', compact('requestModel'));

    }

//    procurement


    /**
     * =========================================================
     * PROCUREMENT - PENDING REQUESTS
     * =========================================================
     */
    public function ProcurementPending(): View
    {
//        abort_unless(
//            auth()->user()->hasRole('Procurement'),
//            403
//        );

        $requests = RequestModel::with([
            'requester',
            'items',
            'attachments',
            'steps.user',
        ])
            ->where(
                'status',
                RequestStatus::PENDING_PROCUREMENT
            )
            ->latest('created_at')
            ->get();

        return view(
            'procurement.pending',
            compact('requests')
        );
    }


    /**
     * =========================================================
     * PROCUREMENT - PROCESS REQUEST
     * =========================================================
     */
    public function processProcurement(
        RequestModel $requestModel
    ): View {
//        abort_unless(
//            auth()->user()->hasRole('Procurement'),
//            403
//        );

        $requestModel->load([
            'requester',
            'items',
            'attachments',
            'steps.user',
        ]);

        /*
         * Only pending Procurement requests
         * can be processed.
         */
        abort_unless(
            $requestModel->status ===
                RequestStatus::PENDING_PROCUREMENT,
            404
        );

        return view(
            'procurement.process',
            compact('requestModel')
        );
    }


    /**
     * =========================================================
     * PROCUREMENT - APPROVE REQUEST
     * =========================================================
     */
    public function approveProcurement(
        HttpRequest $request,
        RequestModel $requestModel
    ): RedirectResponse {
//
//        abort_unless(
//            auth()->user()->hasRole('Procurement'),
//            403
//        );

        /*
         * Validate Procurement input.
         */
        $validated = $request->validate([
            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.supplier' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.supplier_reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.procurement_note' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);


        DB::transaction(function () use (
            $requestModel,
            $validated
        ) {

            /*
             * Reload and lock the request.
             *
             * This prevents two Procurement users
             * from processing the same request at
             * the same time.
             */
            $requestModel = RequestModel::query()
                ->lockForUpdate()
                ->with('items')
                ->findOrFail(
                    $requestModel->id
                );


            /*
             * The request must still be pending
             * Procurement.
             */
            abort_unless(
                $requestModel->status ===
                    RequestStatus::PENDING_PROCUREMENT,
                422
            );


            /*
             * Procurement can process a request
             * only once.
             */
            $alreadyProcessed = $requestModel
                ->steps()
                ->where(
                    'step',
                    RequestStep::PROCUREMENT->value
                )
                ->exists();

            abort_if(
                $alreadyProcessed,
                422,
                'This request has already been processed by Procurement.'
            );


            /*
             * Calculate the grand total
             * on the server.
             */
            $totalAmount = 0;


            foreach (
                $requestModel->items
                as $item
            ) {

                /*
                 * Get submitted data for this item.
                 */
                $data =
                    $validated['items'][$item->id]
                    ?? null;


                /*
                 * Every existing item must have
                 * Procurement data.
                 */
                abort_unless(
                    $data !== null,
                    422
                );


                /*
                 * Unit price entered by Procurement.
                 */
                $unitPrice =
                    (float) $data['unit_price'];


                /*
                 * Quantity comes from the database,
                 * not from the browser.
                 */
                $quantity =
                    (float) $item->quantity;


                /*
                 * Calculate item total.
                 */
                $totalPrice =
                    $quantity * $unitPrice;


                /*
                 * Save Procurement information.
                 */
                $item->update([
                    'unit_price' =>
                        $unitPrice,

                    'total_price' =>
                        $totalPrice,

                    'supplier' =>
                        $data['supplier'],

                    'supplier_reference' =>
                        $data['supplier_reference']
                        ?? null,

                    'procurement_note' =>
                        $data['procurement_note']
                        ?? null,
                ]);


                /*
                 * Add to grand total.
                 */
                $totalAmount +=
                    $totalPrice;
            }


            /*
             * Move request to Finance.
             */
            $requestModel->update([
                'total_amount' =>
                    $totalAmount,

                'status' =>
                    RequestStatus::PENDING_FINANCE,
            ]);


            /*
             * Record Procurement approval.
             */
            $requestModel->steps()->create([
                'user_id' =>
                    auth()->id(),

                'step' =>
                    RequestStep::PROCUREMENT->value,

                'decision' =>
                    RequestDecision::APPROVED->value,

                'comment' =>
                    null,

                'processed_at' =>
                    now(),
            ]);
        });


        return redirect()
            ->route('procurement.pending')
            ->with(
                'success',
                'Request approved successfully and sent to Finance.'
            );
    }


    /**
     * =========================================================
     * PROCUREMENT - REJECT REQUEST
     * =========================================================
     */
    public function rejectProcurement(
        HttpRequest $request,
        RequestModel $requestModel
    ): RedirectResponse {
//
//        abort_unless(
//            auth()->user()->hasRole('Procurement'),
//            403
//        );


        /*
         * Rejection comment is mandatory.
         */
        $validated = $request->validate([
            'comment' => [
                'required',
                'string',
                'min:3',
                'max:2000',
            ],
        ]);


        DB::transaction(function () use (
            $requestModel,
            $validated
        ) {

            /*
             * Reload and lock the request.
             */
            $requestModel = RequestModel::query()
                ->lockForUpdate()
                ->findOrFail(
                    $requestModel->id
                );


            /*
             * Request must still be pending
             * Procurement.
             */
//            abort_unless(
//                $requestModel->status ===
//                    RequestStatus::PENDING_PROCUREMENT,
//                422
//            );


            /*
             * Procurement can process a request
             * only once.
             */
            $alreadyProcessed = $requestModel
                ->steps()
                ->where(
                    'step',
                    RequestStep::PROCUREMENT->value
                )
                ->exists();

            abort_if(
                $alreadyProcessed,
                422,
                'This request has already been processed by Procurement.'
            );


            /*
             * Record rejection.
             */
            $requestModel->steps()->create([
                'user_id' =>
                    auth()->id(),

                'step' =>
                    RequestStep::PROCUREMENT->value,

                'decision' =>
                    RequestDecision::REJECTED->value,

                'comment' =>
                    $validated['comment'],

                'processed_at' =>
                    now(),
            ]);


            /*
             * Reject the request.
             */
            $requestModel->update([
                'status' =>
                    RequestStatus::REJECTED,

                'rejected_at' =>
                    now(),
            ]);
        });


        return redirect()
            ->route('procurement.pending')
            ->with(
                'success',
                'Request rejected successfully.'
            );
    }

public function approvedProcurementRequests(): View
{
    $requests = RequestModel::with([
        'requester',
        'items',
        'attachments',
        'steps.user',
    ])
        ->whereHas('steps', function ($query) {
            $query
                ->where(
                    'step',
                    RequestStep::PROCUREMENT->value
                )
                ->where(
                    'decision',
                    RequestDecision::APPROVED->value
                );
        })
        ->latest('updated_at')
        ->get();

    return view(
        'requests.approved-procurement',
        compact('requests')
    );
}

public function rejectedRProcurementequests(): View
{
    $requests = RequestModel::with([
        'requester',
        'items',
        'attachments',
        'steps.user',
    ])
        ->where(
            'status',
            RequestStatus::REJECTED
        )
        ->latest('rejected_at')
        ->get();

    return view(
        'requests.rejected-procurement',
        compact('requests')
    );
}



}
