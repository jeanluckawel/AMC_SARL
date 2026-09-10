@extends('layouts.admin')

@section('title', 'Create Purchase Order')

@section('content')

    <style>
        .purchase-order-section {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .purchase-order-section-body {
            padding: 20px;
        }

        .purchase-order-table,
        .quotation-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .purchase-order-table th,
        .purchase-order-table td,
        .quotation-items-table th,
        .quotation-items-table td {
            border: 1px solid #dee2e6;
            padding: 12px 14px;
            vertical-align: middle;
        }

        .purchase-order-table th,
        .quotation-items-table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .form-control {
            border-radius: 0 !important;
            min-height: 44px;
        }

        .btn {
            border-radius: 0 !important;
        }

        .file-upload-box {
            border: 1px dashed #0d6efd;
            padding: 10px;
        }

        .upload-help {
            margin-top: 5px;
            color: #6c757d;
            font-size: 12px;
        }

        .purchase-order-actions {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .purchase-order-section-body {
                padding: 10px;
            }

            .purchase-order-table,
            .quotation-items-table {
                font-size: 14px;
            }

            .purchase-order-actions {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>


    {{-- PAGE HEADER --}}
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h3 class="mb-0">
                        Create Purchase Order
                    </h3>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('purchase-orders.index') }}">
                                Purchase Orders
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Create
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    <form
        action="{{ route('purchase-orders.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="purchaseOrderForm"
    >

        @csrf

        <input
            type="hidden"
            name="quotation_id"
            value="{{ $quotation->id }}"
        >


        <div class="purchase-order-section">

            <div class="purchase-order-section-body">


                {{-- CLIENT --}}

                <table class="purchase-order-table">

                    <thead>
                    <tr>
                        <th colspan="2">
                            Client Information
                        </th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>

                        <td>
                            <strong>Client:</strong>
                            {{ $quotation->client->name ?? 'N/A' }}
                        </td>

                        <td>
                            <strong>Quotation:</strong>
                            {{ $quotation->quotario_number }}
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- ITEMS --}}

                <table class="quotation-items-table">

                    <thead>

                    <tr>
                        <th colspan="5">
                            Item Details
                        </th>
                    </tr>

                    <tr>

                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Amount</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse ($quotation->items as $item)

                        <tr>

                            <td>
                                {{ $item->description }}
                            </td>

                            <td class="text-center">
                                {{ number_format($item->quantity, 2) }}
                            </td>

                            <td class="text-center">
                                {{ $item->unit }}
                            </td>

                            <td class="text-end">
                                {{ number_format($item->unit_price, 2) }}
                            </td>

                            <td class="text-end">
                                {{ number_format($item->amount, 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center text-muted">
                                No items available for this quotation.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>


                {{-- PO INFORMATION --}}

                <table class="purchase-order-table">

                    <thead>

                    <tr>

                        <th>
                            PO Number
                        </th>

                        <th>
                            PO Date
                        </th>

                        <th>
                            Upload Purchase Order
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td>

                            <label class="form-label">
                                PO Number
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="po_number"
                                class="form-control @error('po_number') is-invalid @enderror"
                                value="{{ old('po_number') }}"
                                placeholder="Enter PO number"
                                required
                            >

                            @error('po_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </td>


                        <td>

                            <label class="form-label">
                                PO Date
                            </label>

                            <input
                                type="date"
                                name="po_date"
                                class="form-control @error('po_date') is-invalid @enderror"
                                value="{{ old('po_date') }}"
                            >

                            @error('po_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </td>


                        <td>

                            <label class="form-label">
                                Upload Purchase Order
                                <span class="text-danger">*</span>
                            </label>

                            <div class="file-upload-box">

                                <input
                                    type="file"
                                    name="file"
                                    class="form-control @error('file') is-invalid @enderror"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                                    required
                                >

                                <div class="upload-help">
                                    PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — Max 10 MB.
                                </div>

                            </div>

                            @error('file')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror

                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- ACTIONS --}}

                <div class="purchase-order-actions">

                    <a
                        href="{{ route('quotations.show', $quotation->id) }}"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-x-lg me-1"></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        id="uploadBtn"
                    >
                        <i class="bi bi-cloud-arrow-up me-1"></i>
                        Upload Purchase Order
                    </button>

                </div>

            </div>

        </div>

    </form>


    <script>
        document.getElementById('purchaseOrderForm').addEventListener('submit', function () {

            const button = document.getElementById('uploadBtn');

            button.disabled = true;

            button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-1"></span>
            Uploading...
        `;

        });
    </script>

@endsection
