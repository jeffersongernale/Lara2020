@props(['post'=>$post])

<div class="mb-4">
    <a href="{{route('users.posts',$post->user)}}">{{$post->user->name}}</a> 
    <span class="text-gray-600">{{$post->created_at->diffForHumans()}}</span>
    
    <p class="mb-2"> {{$post->body}}</p>
    <div class="flex items-center">
            
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes',$post)}}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes',$post)}}" method="post" class="mr-1">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
                @can('delete', $post)
                    <form action="{{ route('posts.destroy',$post)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
                @endcan
            
        
        <span>{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}}</span>
    </div>
</div>