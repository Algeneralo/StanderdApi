Delete post
<h1>Status:</h1>
<ul>
    <li><b>204:</b> Deleted successfully
        <div class="docs-desc-title__url">
            <pre>{
    "status": 204,
    "message": "Deleted Successfully"
}</pre>
        </div>
    </li>
    <li><b>202:</b> Deleted Failed (maybe id not exists)
        <div class="docs-desc-title__url">
            <pre>{
    "status": 202,
    "message": "Deleted Failed"
}</pre>
        </div>
    </li>
    <li><b style="color: red">500:</b> Intrernal server Error
        <div class="docs-desc-title__url">
            <pre>{
    "status": 500,
    "message": "Internal Server Error",
    "errors": {
        "code": 0,
        "message": "Undefined variable: datsa",
        "file": "F:\\Lumen\\StanderApi\\app\\Http\\Controllers\\Posts.php"
    }
}</pre>
        </div>
    </li>
</ul>
