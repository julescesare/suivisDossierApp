<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructionRequest;
use App\Models\Instruction;

class InstructionController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $instructions = Instruction::all();
        return view('pages.instruction.instruction_list', compact('instructions'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.instruction.instruction_edit', compact('isAdd'));
    }

    public function store(InstructionRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Instruction::create($data);
        return redirect()->route('instructions.index')->with('success', 'Instruction crée avec succès.');
    }

    public function show(Instruction $instruction)
    {
        return view('pages.instruction.show', compact('instruction'));
    }

    public function edit(Instruction $instruction)
    {
        $isAdd = false;
        return view('pages.instruction.instruction_edit', compact('instruction', 'isAdd'));
    }

    public function update(InstructionRequest $request, Instruction $instruction)
    {
        $instruction->update($request->validated());
        return redirect()->route('instruction.index')->with('success', 'Instruction mise à jour avec succès.');
    }

    public function destroy(Instruction $instruction)
    {
        $instruction->delete();
        return redirect()->route('instructions.index')->with('success', 'Instruction supprimée avec succès.');
    }
}
