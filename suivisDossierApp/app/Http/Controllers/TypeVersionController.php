<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeVersionRequest;
use App\Models\TypeVersion;
use Illuminate\Http\Request;

class TypeVersionController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $typeVersions = TypeVersion::all();
        return view('pages.type_version.type_version_list', compact('typeVersions'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.type_version.type_version_edit', compact('isAdd'));
    }

    public function store(TypeVersionRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        TypeVersion::create($data);
        return redirect()->route('type_versions.index')->with('success', 'Type de version creer avec succès.');
    }

    public function show(TypeVersion $typeVersion)
    {
        return view('pages.type_version.type_version_show', compact('typeVersion'));
    }

    public function edit(TypeVersion $typeVersion)
    {
        $isAdd = false;
        return view('pages.type_version.type_version_edit', compact('typeVersion', 'isAdd'));
    }

    public function update(TypeVersionRequest $request, TypeVersion $typeVersion)
    {
        $typeVersion->update($request->validated());
        return redirect()->route('type_versions.index')->with('success', 'Type de version mis à jour avec succès.');
    }

    public function destroy(TypeVersion $typeVersion)
    {
        $typeVersion->delete();
        return redirect()->route('type_versions.index')->with('success', 'Type de version supprimé avec succès.');
    }
}
