
@if(isset($imgPath))
    网络附件
    <br>
    <img src='{{$message->embed($imgPath)}}'>
@endif



@if(isset($local_imgPath))
    本地图片
    <br>
    <img src="{{$message->embedData($local_imgPath,'我的自拍照.jpg')}}">
@endif