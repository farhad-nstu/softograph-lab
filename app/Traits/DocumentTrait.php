<?php


namespace App\Traits;
use Illuminate\Support\Facades\Mail;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\Collection;
use Carbon\Carbon;
use PDF;
use DB;

trait DocumentTrait
{
    public function process_images($request, $product_id){
        $status = false;
        if (isset($request->documents) && count($request->documents) > 0) {
            for ($i = 0; $i < count($request->documents); $i++) {
                $directory = 'images/products' . '/' . $$product_id;

                // $claimDoc = new ProductImage();
                // $claimDoc->claim_id = $claim_id;
                // $claimDoc->document_path = "test.jpg";
                // $claimDoc->save();
                // $imageData = $this->process_image($request->documents[$i], $directory, $claimDoc->id);
                // $claimDoc->document_path = $directory.'/'.$imageData['imageName'];
                // $claimDoc->save();
                // $status = true;
            }
        }
        return $status;
    }

    public function store_image($image, $path, $document_id=null){
        $imageData = [];
        $extension = $image->getClientOriginalExtension();
        $imageName = $document_id . '.' . $extension;
        $image->move(($path . '/'), $imageName);
        $imageData['imageName'] = $imageName;
        $imageData['extension'] = $extension;
        return $imageData;
    }
}
