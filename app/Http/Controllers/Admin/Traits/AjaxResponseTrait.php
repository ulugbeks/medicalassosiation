<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait AjaxResponseTrait
{
    /**
     * Handle AJAX request response for store operations
     */
    protected function handleAjaxStore(Request $request, callable $storeCallback, string $successMessage = 'Item created successfully!', array $additionalData = [])
    {
        try {
            $result = $storeCallback();
            
            if ($request->ajax()) {
                return response()->json(array_merge([
                    'success' => true,
                    'message' => $successMessage,
                ], $additionalData));
            }
            
            return $result;
            
        } catch (ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
    
    /**
     * Handle AJAX request response for update operations
     */
    protected function handleAjaxUpdate(Request $request, callable $updateCallback, string $successMessage = 'Item updated successfully!', array $additionalData = [])
    {
        try {
            $result = $updateCallback();
            
            if ($request->ajax()) {
                return response()->json(array_merge([
                    'success' => true,
                    'message' => $successMessage,
                ], $additionalData));
            }
            
            return $result;
            
        } catch (ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
    
    /**
     * Handle AJAX request response for delete operations
     */
    protected function handleAjaxDelete(Request $request, callable $deleteCallback, string $successMessage = 'Item deleted successfully!')
    {
        try {
            $result = $deleteCallback();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMessage,
                ]);
            }
            
            return $result;
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while deleting: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}