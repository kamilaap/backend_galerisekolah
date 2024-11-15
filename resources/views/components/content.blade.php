<div class="content">
    {!! preg_replace('/#(\w+)/', '<a href="'.url('/hashtag/$1').'">#$1</a>', $content) !!}
</div> 
