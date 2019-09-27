<?php

namespace App\Http\Controllers\Admin;

use App\Caching\Countries;
use App\Models\University;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Universities\UniversityStoreRequest;
use App\Http\Requests\Admin\Universities\UniversityUpdateRequest;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()) {
            return response([
                'collection' => University::filter()
            ]);
        }

        return view('admin.universities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.universities.create', [
            'countries' => resolve(Countries::class)->all()
        ]);
    }

    /**
     * Store a university
     * @param UniversityStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UniversityStoreRequest $request)
    {
        University::create($request->validated());

        session()->flash('success', 'University Created Successfully');

        return redirect(route('admin.universities.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        return view('admin.universities.edit', [
            'university' => $university,
            'countries' => resolve(Countries::class)->all(),
        ]);
    }


    /**
     * Update a university
     * @param University $university
     * @param UniversityUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(University $university, UniversityUpdateRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $data['image'] ?: $university->image;
        $university->update($data);

        session()->flash('success', 'University Updated Successfully');

        return redirect(route('admin.universities.index'));
    }


    /**
     * Delete a university
     * @param University $university
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(University $university)
    {
        $university->delete();

        return response([], 204);
    }
}
