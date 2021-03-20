<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function index()
    {
        $banks = Bank::OrderBy("id", "DESC")->paginate(2)->toArray();
        $response = [
            "total_count" => $banks["total"],
            "limit" => $banks["per_page"],
            "pagination" => [
                "next_page" => $banks["next_page_url"],
                "current_page" => $banks["current_page"]
            ],
            "data" => $banks["data"], 
        ];

        return response()->json($response, 200);
    }
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml')

        $input = $request->all();
        $validationRules = [
            'Nama_Bank' => 'required|min:3',
            'Nama' => 'required|min:5',
            'Saldo' => 'required|min:6'
          
        ];
        $validator = \Validator::make($input, $validationRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $bank = Bank::create($input);
        return response()->json($bank, 200);
    }
    public function show($id)
    {
        $bank = Bank::find($id);

        if(!$bank) {
            abort(404);
        }

        return response()->json($bank, 200);
    }
    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml')

        $input = $request->all();
        $bank = Bank::find($id);

        if(!$bank) {
            abort(404);
        }
        $validationRules = [
            'Nama_Bank' => 'required|min:3',
            'Nama' => 'required|min:5',
            'Saldo' => 'required|min:6'
          
        ];
        $validator = \Validator::make($input, $validationRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bank->fill($input);
        $bank->save();

        return response()->json($bank, 200);
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);

        if(!$bank) {
            abort(404);
        }
        $bank->delete();
        $message = ['message' => 'deleted successfully', 'bank_id' => $id];

        return response()->json($message, 200);
    }
}