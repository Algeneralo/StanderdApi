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
            $postsData = PostModel::paginate(8);
            foreach ($postsData as $key => $datum) {
                $postsData[$key]['user'] = $postsData[$key]->user;
                $postsData[$key]['comments'] = $postsData[$key]->comments;
            }

        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        if ($postsData->isEmpty())
            return $this->noContentResponse("Fetched Successfully");
        return $this->successResponse('Fetched Successfully', ['posts' => $postsData]);
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
            $postData = PostModel::where('id', $id)->first();
            if (!$postData)
                return $this->noContentResponse("Fetched Successfully");
            $postData['user'] = $postData->user;
            $postData['comments'] = $postData->comments;
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
        return $this->successResponse('Fetched Successfully', ['post' => $postData]);
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