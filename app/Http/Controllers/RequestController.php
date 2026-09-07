<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Models\RequestModel;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        $query = RequestModel::with('requester');

        if ($user->hasRole('Finance')) {
            $query->where('status', RequestStatus::PENDING_FINANCE);

        } elseif ($user->hasRole('Procurement')) {
            $query->where('status', RequestStatus::PENDING_PROCUREMENT);

        } elseif ($user->hasRole('CEO')) {
            $query->where('status', RequestStatus::PENDING_CEO);

        } else {
            $query->where('requester_id', $user->id);
        }

        $requests = $query
            ->latest()
            ->get();

        return view('requests.index', compact('requests'));
    }
}
