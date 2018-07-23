<?php
/**
 * Created by PhpStorm.
 * User: Algeneral
 * Date: 7/22/2018
 * Time: 2:09 PM
 */

namespace App\Http\Controllers;

use App\models\Posts as PostModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class Posts extends ApiController
{

    /**
     * return all posts data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = PostModel::all();
            foreach ($data as $key => $datum) {
                $data[$key]['user'] = $data[$key]->user;
                $data[$key]['comments'] = $data[$key]->comments;
            }
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        if ($data->isEmpty())
            return $this->noContentResponse("Fetched Successfully");
        return $this->successResponse('Fetched Successfully', ['posts' => $data]);
    }

    /**
     * return specific post by id
     *
     * @param $id : for post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = PostModel::where('id', $id)->first();
            $data['user'] = $data->user;
            $data['comments'] = $data->comments;
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        if (!$data)
            return $this->noContentResponse("Fetched Successfully");
        return $this->successResponse('Fetched Successfully', ['post' => $data]);
    }

    /**
     *
     * create new post
     *
     * @param Request $request :post information
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {

            //validation rules
            $rules = [
                'details' => 'required',
                'user_id' => 'required|Integer'
            ];
            //validate request inputs
            $validator = Validator::make($request->all(), $rules);
            //return response with status 422 that mean validation error
            if ($validator->fails()) {
                return $this->validationErrorResponse($validator);
            }
            $post = [
                'details' => $request->input('details'),
                'user_id' => $request->input('user_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $createdPost = PostModel::create($post);
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        return $this->createResponse($createdPost);
    }

    /**
     *update post
     *
     * @param Request $request : form data
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'details' => 'required',
            ];
            //validate request inputs
            $validator = Validator::make($request->all(), $rules);
            //return response with status 422 that mean validation error
            if ($validator->fails()) {
                return $this->validationErrorResponse($validator);
            }
            $post = [
                'details' => $request->input('details'),
                'updated_at' => Carbon::now(),
            ];
            $updatedStatus = PostModel::where('id', $id)->update($post);
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        if ($updatedStatus)
            return $this->noContentResponse("Updated Successfully");
        return $this->failedResponse('Updated Failed');
    }

    /**
     *
     * delete post by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $updatedStatus = PostModel::where('id', $id)->delete();
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        if ($updatedStatus)
            return $this->noContentResponse("Deleted successfully");
        return $this->failedResponse('Deleted Failed');
    }
}