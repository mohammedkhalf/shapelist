<?php

namespace App\Http\Controllers\Backend\Media;
use Illuminate\Http\Request;
use App\MediaFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Status\Status;

class MediaController extends Controller
{
    private $mediaFile;
    public function __construct(MediaFile $mediaFile)
    {
        $this->mediaFile = $mediaFile;
    }
    public function UploadMedia(Request $request,$order)
    {
        dd($request->all());
        $request->validate([
            'status_id' =>['numeric','not_in:0','exists:'. Status::table() .',id'],
            'media_file' => 'file|mimes:zip,rar|application/octet-stream'
        ]);
        $OrderObj=$order->update($request->only('status_id'));
        $path = Storage::disk('s3')->put('MediaFolder/Order-Media', $request->file);
        $request->merge([
            'size' => $request->file->getClientSize(),
            'path' => $path,
            'order_id' => $OrderObj->id
        ]);
        $this->mediaFile->create($request->only('path', 'title', 'size'));
        return back()->with('success', 'File Successfully Saved');
    }
}
