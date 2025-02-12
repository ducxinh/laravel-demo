<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiDocsController extends Controller
{
    public function index()
    {
        return view('apidocs');
    }

    public function getData()
    {
        $data = file_get_contents(public_path().'/swagger/swagger.json');
        $data = json_decode($data, true);

        $pathsFiles = [
            'auth/index.json',
            'user/index.json',
        ];

        $schemaFiles = [
            'common/index.json',
            'auth/index.json',
            'user/index.json',
        ];

        $pathsData = [];
        foreach ($pathsFiles as $pathsFile) {
            $sourcePath = public_path()."/swagger/data/paths/{$pathsFile}";
            $jsonContent = file_get_contents($sourcePath);
            $dataArray = json_decode($jsonContent, true);
            $pathsData = array_merge_recursive($pathsData, $dataArray);
        }
        $data['paths'] = $pathsData;

        $schemaData = [];
        foreach ($schemaFiles as $schemaFile) {
            $sourcePath = public_path()."/swagger/data/schemas/{$schemaFile}";
            $jsonContent = file_get_contents($sourcePath);
            $dataArray = json_decode($jsonContent, true);
            $schemaData = array_merge_recursive($schemaData, $dataArray);
        }

        $data['components']['schemas'] = $schemaData;

        return $data;
    }
}
