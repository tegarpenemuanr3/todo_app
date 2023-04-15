<?php

namespace App\Controllers\Api;

use App\Models\TodosModel;
use CodeIgniter\RESTful\ResourceController;

class Todos extends ResourceController
{
    // http://localhost:8080/api/todos
    public function index()
    {
        $model = new TodosModel;
        $data = $model->orderBy('todo_id','ASC')->findAll(); // Default ASC
        
        return $this->respond([
            "data" => $data
        ]);
    }

    // http://localhost:8080/api/todos/3
    public function show($id = null)
    {
        $model = new TodosModel;
        $data = $model->find($id); 

        return $this->respond([
            "data" => $data
        ]);
    }

    public function new() {}

    // http://localhost:8080/api/todos
    public function create()
    {
        if(!$this->validate([
            'todo_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Title tidak boleh kosong'
                ]
            ]
        ])) {
            return $this->respond([
                "message" => $this->validator->getErrors()
            ],400);
        };

        $data = $this->request->getVar();

        $model = new TodosModel;
        $result = $model->insert($data);
        $dataInsert = $model->find($result);

        return $this->respondCreated([
            "status" => "Data berhasil diinput",
            "data" => $dataInsert
        ]);
    }

    public function edit($id = null) {}

    public function update($id = null)
    {
        $model = new TodosModel;
        if(!$model->find($id))
        {
            return $this->fail("Data tidak ditemukan");
        }

        $data = $this->request->getVar();
        $model->update($id, $data);
        $dataUpdate = $model->find($id);

        return $this->respondUpdated([
            "status" => "Data berhasil diupdate",
            "data" => $dataUpdate
        ]);
    }


    public function delete($id = null)
    {
        $model = new TodosModel;
        
        if(!$model->find($id))
        {
            return $this->fail("Data tidak ditemukan");
        }
        $data = $model->delete($id);

        return $this->respondDeleted([
            "status" => "Data berhasil dihapus",
        ]);
    }
}
