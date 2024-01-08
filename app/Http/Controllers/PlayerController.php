<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Http\Resources\PlayerResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    public function index()
    {
        $player = Player::with('createdDetail:id,username')->get();
        return PlayerResource::collection($player);
    }
    public function delete($id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Player not found'], 404);
        }

        $player->delete();

        return response()->json(['message' => 'Player deleted successfully'], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'posisi' => 'required|string',
            'nama' => 'required|string',
            'nomer_punggung' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Player not found'], 404);
        }

        $modifyBy = Auth::id();

        $player->posisi = $request->posisi;
        $player->nama = $request->nama;
        $player->nomer_punggung = $request->nomer_punggung;
        $player->created_by = $modifyBy;
        $player->updated_at = now();

        $player->save();

        return new PlayerResource($player);
    }
    public function show($id)
    {
        $player = Player::find($id);

        if (!$player) {
            return response()->json(['message' => 'Player not found'], 404);
        }

        return response()->json(new PlayerResource($player));
    }
}
