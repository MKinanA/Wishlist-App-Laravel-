<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="../tw.css">
    @if (isset($edit_data))
    <script>
        sessionStorage.setItem('id', '{{$edit_data["id"]}}');
        sessionStorage.setItem('img', '{{$edit_data["img"]}}');
        sessionStorage.setItem('img_type', '{{$edit_data["img_type"]}}');
        sessionStorage.setItem('name', '{{$edit_data["name"]}}');
        sessionStorage.setItem('price', '{{$edit_data["price"]}}');
        sessionStorage.setItem('desc', '{{$edit_data["desc"]}}');
        sessionStorage.setItem('edit', 'true');
        history.back();
    </script>
    @endif
</head>
<body class="text-white">
    <div class="navbar bg-base-100 sticky top-0 px-[10vw] z-10 shadow-2xl">
        <a class="btn btn-ghost text-xl"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg> My Wishlist</a>
    </div>
    <div class="px-[10vw] mt-8">
        <div class="card w-full bg-base-100 border-2 border-neutral-content rounded-xl mb-8" id="input-card">
            <div class="card-body p-6 gap-4">
                <form method="post" action="../new" class="flex flex-row gap-4" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                    @method('put')
                    <input id="input-id" type="number" name="id" hidden>
                    <label class="flex flex-col gap-0 border-2 border-neutral-content rounded-lg overflow-hidden justify-between items-center">
                        <img id="image-preview" src="../image_placeholder.png" class="h-60 w-60 object-cover border-none cursor-pointer">
                        <input id="image-input" type="file" name="img" class="file-input w-full max-w-xs rounded-none" accept="image/*"/>
                    </label>
                    <input id="image-type-input" type="text" name="img_type" hidden>
                    <div class="flex flex-col gap-4 w-full">
                        <h2 class="card-title ml-1 flex flex-row gap-4 items-center">
                            <span id="input-title">Add new wishlist</span>
                            <button id="reload-button" class="font-thin text-4xl -mt-1.5" onclick="location.reload(); return false;" hidden>&Cross;</button>
                        </h2>
                        <label class="input input-bordered flex items-center gap-1 border-2 border-neutral-content">
                            Product name:&nbsp;
                            <input id="input-name" type="text" class="grow" placeholder="The name of the product" name="name" required/>
                        </label>
                        <label class="input input-bordered flex items-center gap-1 border-2 border-neutral-content">
                            Price:&nbsp;
                            <input id="input-price" type="text" class="grow" placeholder="Price of the product, enter any currency, or anything" name="price"/>
                        </label>
                        <label class="input input-bordered flex items-center gap-1 border-2 border-neutral-content">
                            Description:&nbsp;
                            <input id="input-desc" type="text" class="grow" placeholder="Why do you want the product? Why is it important?" name="desc"/>
                        </label>
                        <div class="card-actions flex flex-row gap-4 justify-end absolute bottom-6 right-6">
                            <button id="submit-button" class="btn btn-square border-2 border-neutral-content btn-sm" type="submit" onclick="sessionStorage.setItem('scroll-bottom', 'true');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($data))
        @foreach ($data as $item)
        <div class="card w-full bg-base-100 border-2 border-neutral-content rounded-xl mb-8">
            <div class="card-body flex flex-row gap-4 p-6">
                @php
                $img_data = base64_encode($item->img);
                $img = "data:{$item->img_type};base64,{$img_data}" != "data:;base64," ? "data:{$item->img_type};base64,{$img_data}" : "../image_placeholder.png";
                @endphp
                @if ("data:{$item->img_type};base64,{$img_data}" != "data:;base64,")
                <img src="{{$img}}" class="h-56 w-56 object-cover border-2 border-neutral-content rounded-lg">
                @endif
                <div class="w-full">
                    <h2 class="text-2xl card-title">{{$item->name}}</h2>
                    @if ($item->price != '')
                    <p class="mb-2 mt-1"><span class="text-neutral-content">Price:&nbsp;</span>{{$item->price}}</p>
                    @endif
                    @if ($item->desc != '')
                    <p>{{$item->desc}}</p>
                    @endif
                    <div class="card-actions flex flex-row gap-4 justify-end absolute bottom-6 right-6">
                        <form action="../edit" method="post">
                            @csrf <!-- {{ csrf_field() }} -->
                            <input type="number" name="id" value="{{$item->id}}" hidden>
                            <input type="text" name="img" value="{{$img_data}}" hidden>
                            <input type="text" name="img_type" value="{{$item->img_type}}" hidden>
                            <input type="text" name="name" value="{{$item->name}}" hidden>
                            <input type="text" name="price" value="{{$item->price}}" hidden>
                            <input type="text" name="desc" value="{{$item->desc}}" hidden>
                            <button type="submit" class="btn btn-square border-2 border-neutral-content btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                            </button>
                        </form>
                        <form action="../delete" method="post">
                            @csrf <!-- {{ csrf_field() }} -->
                            @method('delete')
                            <input type="number" name="id" value="{{$item->id}}" hidden>
                            <button type="submit" class="btn btn-square border-2 border-neutral-content btn-sm" onclick="return confirm('Are you sure you want to delete this wishlist of {{$item->name}}?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <script src="../script.js"></script>
</body>
</html>