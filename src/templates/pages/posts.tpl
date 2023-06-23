<div id="postsPage">

    <h2>{{ heading }}</h2>

    <form action="/posts" method="post">
        <input type="text" name="name" placeholder="Enter your name...">
        <button type="submit">Submit</button>
    </form>

    {if isset($body) and $body.name|count_characters > 0}

        <p>Hello, {$body.name|capitalize}.</p>

    {/if}

</div>