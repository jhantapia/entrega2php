<?php

namespace App\Http\Controllers\CrudHelper;

use App\Http\Controllers\ControllerUtils as Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerCrud
{
    private $objectClass;
    private $indexPage;
    private $customQueryIndex;
    private $customQueryGetAll;
    private $customQueryShow;
    private $customQueryEdit;
    private $customQueryStore;
    private $customQueryUpdate;
    private $customQueryDestroy;
    private $customQueryChangeStatus;
    private $successMessage;
    private $validationEdit;
    private $validationStore;
    private $validationUpdate;

    public function __construct($objectClass)
    {
        $this->objectClass = $objectClass;
        $this->validationStore = new Validation();
        $this->validationUpdate = new Validation();
    }

    public function index(){
        return view($this->indexPage);
    }

    public function getAll(Request $request)
    {
        $objectClass = $this->objectClass;

        if ($request->isJson()) {
            $objectClass = $this->customQueryGetAll ? $this->customQueryGetAll : $objectClass::all();
            return response()->json($objectClass);
        } else {
            return "No Disponible";
        }
    }

    public function show($id)
    {
        $objectClass = $this->objectClass;

        try {
            $objectClass = $this->customQueryShow ? $this->customQueryShow : $objectClass::find($id);

            if ($objectClass) {
                return Util::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro encontrado.");

            } else {
                return Util::errorResponseJson('registro no encontrado.');
            }
        } catch (\Exception $e) {
            return Util::errorResponseJson('ha ocurrido un error inesperado, intentalo denuevo más tarde.');
        }
    }

    public function edit(Request $request)
    {
        $objectClass = $this->objectClass;
        $validation = $this->validationEdit;

        $validator = null;

        if ($validation) {
            $validator = Validator::make($validation->getRequest(), $validation->getRules(), $validation->getMessages());
        }

        if ($validator->passes()) {

            $objectClass = $this->customQueryShow ? $this->customQueryShow : $objectClass::find($request->id);

            if ($objectClass) {
                return ControllerUtils::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro editado correctamente.");

            } else {
                return ControllerUtils::errorResponseJson('registro no encontrado.');
            }
        }
        return ControllerUtils::errorResponseValidation($validator);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $objectClass = $this->objectClass;
        $validation = $this->validationStore;

        $validator = null;

        if ($validation) {
            $validation->setRequest($request->all());
            $validator = Validator::make($validation->getRequest(), $validation->getRules(), $validation->getMessages());
        }

        if ($validator->passes()) {

            $objectClass = $this->customQueryStore ? $this->customQueryStore : $objectClass::create($request->all());

            if($objectClass){
                return ControllerUtils::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro creado correctamente.");
            }
            return ControllerUtils::errorResponseJson('No se ha podido realizar el registro.');
        }
        return ControllerUtils::errorResponseValidation($validator);
    }

    public function update(Request $request){

        $objectClass = $this->objectClass;
        $validation = $this->validationUpdate;

        $validator = null;

        if ($validation) {
            $validation->setRequest($request->all());
            $validator = Validator::make($validation->getRequest(), $validation->getRules(), $validation->getMessages());
        }


        if ($validator->passes()) {

            $objectClass = $this->customQueryUpdate ? $this->customQueryUpdate : $objectClass::find($request->id);

            if ($objectClass) {

                $objectClass->update($request->all());
                return ControllerUtils::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro actualizado correctamente.");

            } else {
                return ControllerUtils::errorResponseJson('registro no actualizado.');

            }
        }
        return ControllerUtils::errorResponseValidation($validator);
    }

    public function destroy(Request $request)
    {
        $objectClass = $this->objectClass;
        $objectClass = $this->customQueryDestroy ? $this->customQueryDestroy : $objectClass::find($request->id);

        if ($objectClass) {

            $objectClass->delete();
            return ControllerUtils::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro eliminado correctamente.");

        } else {
            return ControllerUtils::errorResponseJson('registro no econtrado.');
        }
    }

    public function changeStatus(Request $request){

        $objectClass = $this->objectClass;
        $objectClass = $this->customQueryChangeStatus ? $this->customQueryChangeStatus : $objectClass::find($request->id);

        if ($objectClass) {

            $objectClass->active = $request->active;
            $objectClass->save();

            return ControllerUtils::successResponseJson($objectClass, $this->successMessage ? $this->successMessage : "Registro actualizado correctamente.");

        } else {
            return ControllerUtils::errorResponseJson('registro no actualizado.');

        }
    }

    /**
     * @param mixed $objectClass
     */
    public function setObjectClass($objectClass)
    {
        $this->objectClass = $objectClass;
    }

    /**
     * @param mixed $indexPage
     */
    public function setIndexPage($indexPage)
    {
        $this->indexPage = $indexPage;
    }

    /**
     * @param mixed $customQueryIndex
     */
    public function setCustomQueryIndex($customQueryIndex)
    {
        $this->customQueryIndex = $customQueryIndex;
    }

    /**
     * @param mixed $customQueryGetAll
     */
    public function setCustomQueryGetAll($customQueryGetAll)
    {
        $this->customQueryGetAll = $customQueryGetAll;
    }

    /**
     * @param mixed $customQueryShow
     */
    public function setCustomQueryShow($customQueryShow)
    {
        $this->customQueryShow = $customQueryShow;
    }

    /**
     * @param mixed $customQueryEdit
     */
    public function setCustomQueryEdit($customQueryEdit)
    {
        $this->customQueryEdit = $customQueryEdit;
    }

    /**
     * @param mixed $customQueryStore
     */
    public function setCustomQueryStore($customQueryStore)
    {
        $this->customQueryStore = $customQueryStore;
    }

    /**
     * @param mixed $customQueryUpdate
     */
    public function setCustomQueryUpdate($customQueryUpdate)
    {
        $this->customQueryUpdate = $customQueryUpdate;
    }

    /**
     * @param mixed $customQueryDestroy
     */
    public function setCustomQueryDestroy($customQueryDestroy)
    {
        $this->customQueryDestroy = $customQueryDestroy;
    }

    /**
     * @param mixed $customQueryChangeStatus
     */
    public function setCustomQueryChangeStatus($customQueryChangeStatus)
    {
        $this->customQueryChangeStatus = $customQueryChangeStatus;
    }

    /**
     * @param mixed $successMessage
     */
    public function setSuccessMessage($successMessage)
    {
        $this->successMessage = $successMessage;
    }

    /**
     * @param mixed $validationEdit
     */
    public function setValidationEdit($validationEdit)
    {
        $this->validationEdit = $validationEdit;
    }


    /**
     * @param $rules
     * @param array $messages
     */
    public function setValidationStore($rules, $messages = [])
    {
        $this->validationStore->setRules($rules);
        $this->validationStore->setMessages($messages);
    }

    /**
     * @param $rules
     * @param array $messages
     */
    public function setValidationUpdate($rules, $messages = [])
    {
        $this->validationUpdate->setRules($rules);
        $this->validationUpdate->setMessages($messages);
    }

}

