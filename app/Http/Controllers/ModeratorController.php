<?php

namespace App\Http\Controllers;

use App\Models\RegistrationForm;
use App\Models\StudentsSscInfo;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{


    public function index(Request $request)
    {
        $hscGroupFilter = $request->input('hsc_group');
        $transactionStatusFilter = $request->input('transaction_status');
        $approvalStatusFilter = $request->input('approved'); // New filter for approval status

        $query = RegistrationForm::with(['transaction', 'ssc_info'])->select(['name', 'father_name', 'user_id', 'approved']);

        // Apply HSC Group filter
        if ($hscGroupFilter) {
            $query->whereHas('ssc_info', function ($q) use ($hscGroupFilter) {
                $q->where('hsc_group', $hscGroupFilter);
            });
        }

        // Apply Transaction Status filter
        if ($transactionStatusFilter !== null) {
            $query->whereHas('transaction', function ($q) use ($transactionStatusFilter) {
                $q->where('transaction_status', $transactionStatusFilter);
            });
        }

        // Apply Approval Status filter
        if ($approvalStatusFilter !== null) {
            $query->where('approved', $approvalStatusFilter);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'name' => $item->name,
                'father_name' => $item->father_name,
                'board_name' => optional($item->ssc_info)->board_name,
                'ssc_group' => optional($item->ssc_info)->ssc_group,
                'roll' => optional($item->ssc_info)->roll,
                'hsc_group' => optional($item->ssc_info)->hsc_group,
                'mobile' => optional($item->ssc_info)->mobile,
                'transaction_status' => optional($item->transaction)->transaction_status,
                'transaction' => optional($item->transaction),
                'approved' => $item->approved, // Added approved field
                'user_id' => $item->user_id, // Added approved field
            ];
        });

        // Get unique HSC groups for the filter dropdown
        $hscGroups = StudentsSscInfo::select('hsc_group')->distinct()->pluck('hsc_group');

        return view('moderator.index', compact('data', 'hscGroups', 'hscGroupFilter', 'transactionStatusFilter', 'approvalStatusFilter'));
    }


}
