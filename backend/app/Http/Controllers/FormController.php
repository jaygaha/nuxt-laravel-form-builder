<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormLayout;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get all resources
     *
     * @return void
     */
    public function index()
    {
        return response()->json(
            [
                "status_code"=> 200,
                "success"=> true,
                "message"=> "data fetced successfully",
                'data' => Form::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'mapping_url' => 'required',
            'form_layout' => 'required|json'
        ]);

        try {
            $form = new Form;
            $form->title = $request->input('title');
            $form->version = 1;
            $form->mapping_url = $request->input('mapping_url');

            $form->save();

            $formLayout = new FormLayout;
            $formLayout->form_id = $form->id;
            $formLayout->version = $form->version;
            $formLayout->form_layout = $request->input('form_layout');

            $formLayout->save();

            //return success message
            return response()->json(
                [
                    "status_code"=> 201,
                    "success"=> true,
                    "message"=> "data saved successfully",
                    'data' => [
                        'created' => true,
                        'form_id' => $form->id
                    ],
                ], 201
            );
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'An error occured while saving.'], 409);
        }
    }

    /**
     * Edit specified resource
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $form = Form::with(['layouts' => function ($q) {
            $q->orderBy('version', 'desc');
            $q->limit(1);
        }])->find($id);

        if ($form == null) {
            return response()->json(['error' => 'This form doesnt existed']);
        }

        $result = [
            'title' => $form->title,
            'version' => $form->version,
            'layout' => $form->layouts[0]->form_layout,
            'mapping_url' => $form->mapping_url
        ];

         //return success message
         return response()->json(
            [
                "status_code"=> 200,
                "success"=> true,
                "message"=> "data fetched successfully",
                'data' => $result,
            ], 200
        );
    }

    /**
     * Update a resource by ID
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'mapping_url' => 'required',
            'form_layout' => 'required|json'
        ]);

        try {
            $form = Form::find($id);
            // update form
            $form->title = $request->input('title');;
            $form->version++;
            $form->mapping_url = $request->input('mapping_url');;
            $form->save();

            $formLayout = new FormLayout;
            $formLayout->form_id = $form->id;
            $formLayout->version = $form->version;
            $formLayout->form_layout = $request->input('form_layout');

            $formLayout->save();

            //return success message
            return response()->json(
                [
                    "status_code"=> 200,
                    "success"=> true,
                    "message"=> "data saved successfully",
                    'data' => [
                        'updated' => true,
                        'form_id' => $form->id
                    ],
                ]
            );

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'An error occured while saving.'], 409);
        }
    }
}
