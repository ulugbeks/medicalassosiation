<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Http\Controllers\Admin\Traits\AjaxResponseTrait;

class TeamController extends Controller
{
    use AjaxResponseTrait;
    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        return $this->handleAjaxStore($request, function() use ($request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'image' => 'required|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                'active' => 'boolean',
            ]);

            $teamMember = TeamMember::create($request->all());

            return redirect()->route('team.index')
                ->with('success', 'Team member created successfully.');
        }, 'Team member created successfully!');
    }

    public function edit(TeamMember $member)
    {
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, TeamMember $member)
    {
        return $this->handleAjaxUpdate($request, function() use ($request, $member) {
            $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'image' => 'required|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                'active' => 'boolean',
            ]);

            $member->update($request->all());

            return redirect()->route('team.index')
                ->with('success', 'Team member updated successfully');
        }, 'Team member updated successfully!');
    }

    public function destroy(TeamMember $member)
    {
        return $this->handleAjaxDelete(request(), function() use ($member) {
            $member->delete();

            return redirect()->route('team.index')
                ->with('success', 'Team member deleted successfully');
        }, 'Team member deleted successfully!');
    }
}