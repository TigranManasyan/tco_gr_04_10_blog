jQuery(document).ready(function($) {
    const backendURL = "http://blog.loc/routes/web.php";
    if($("body").attr("id") == 'all-posts') {
        let printPosts = dataPost => {
            let row = '';
            dataPost.forEach( post => {
                row += `
                    <tr>
                        <td>${post.title}</td>
                        <td>${post.content}</td>
                        <td>${post.published_at}</td>
                        <td>${post.first_name} ${post.last_name}</td>
                        <td>
                            <button class="btn btn-success">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                `;
            });

            return row;
        }

        $.ajax({
            url:backendURL,
            method:'get',
            data:{action:'all-posts'},
            dataType:"json",
            success:function(data) {
                console.log(data);
                if(data.status == 200) {
                    $("#post-list").html(printPosts(data.data))
                }
            }
        })
    }
})