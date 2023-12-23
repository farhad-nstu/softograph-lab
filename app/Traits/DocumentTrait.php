<?php


namespace App\Traits;

use App\Models\CardAttachment;

trait DocumentTrait
{
    public function process_documents($request, $obj_id=null){
        $status = false;
        if (isset($request->card_documents) && count($request->card_documents) > 0) {
            for ($i = 0; $i < count($request->card_documents); $i++) {
                $directory = 'card/documents' . '/' . $obj_id;

                $card_doc = new CardAttachment();
                $card_doc->card_id = $obj_id;
                $card_doc->document_path = "test.jpg";
                $card_doc->save();
                $file_data = $this->process_image($request->card_documents[$i], $directory, $card_doc->id);
                $card_doc->document_path = $directory.'/'.$file_data['imageName'];
                if($card_doc->save()){
                    $status = true;
                }
            }
        }
        return $status;
    }

    public function process_image($image, $path, $document_id=null){
        $file_data = [];
        $extension = $image->getClientOriginalExtension();
        $imageName = $document_id . '.' . $extension;
        $image->move(($path . '/'), $imageName);
        $imageData['imageName'] = $imageName;
        $imageData['extension'] = $extension;
        return $imageData;
    }
}
