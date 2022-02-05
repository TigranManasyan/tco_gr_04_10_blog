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
                            <a href="http://blog.loc/views/posts/edit_post.php?post_id=${post.id}" class="btn btn-success">Edit</a>
                            <button data-id="${post.id}" class="btn-delete-post btn btn-danger">Delete</button>
                        </td>
                    </tr>
                `;
            });

            $("#post-list").html( row);
            $(".btn-delete-post").on("click", function() {
                let post_id = $(this).data("id");
                $.ajax({
                    url:backendURL,
                    method:'get',
                    data:{action:'delete_post', post_id},
                    dataType:"json",
                    success:function(data) {
                        alert(data.msg);
                        location.reload();
                    }
                })
            })
        }


        $.ajax({
            url:backendURL,
            method:'get',
            data:{action:'all-posts'},
            dataType:"json",
            success:function(data) {
                console.log(data);
                if(data.status == 200) {
                    printPosts(data.data);
                }
            }
        })
    } else if($("body").attr("id") == 'new-post') {
        $("#save-post").on("submit", function(e) {
            e.preventDefault();
            let title = $("#title").val();
            let content = $("#content").val();
            let user_id = $("#user_id").val();
            $.ajax({
                url:backendURL,
                method:'post',
                data:{action:'new-post', title, content, user_id},
                dataType:"json",
                success:function(data) {
                    alert(data.msg);
                    location.reload();
                }
            })
        })
    } else if($("body").attr("id") == 'edit-post') {
        let post_id = parseInt($("#post_id").text());
        $.ajax({
            url:backendURL,
            method:'get',
            data:{action:'edit-post', post_id},
            dataType:"json",
            success:function(data) {
                console.log(data)
               if(data.status != '200') {
                   $("#edit-post").html("Post not found");
               } else {
                   $("#title").val(data.data[0].title)
                   $("#content").val(data.data[0].content)
               }

            }
        })



        $("#update-post").on("submit", function(e) {
            e.preventDefault();
            let title = $("#title").val();
            let content = $("#content").val();
            let user_id = $("#user_id").val();
            // console.log(title, content, user_id, post_id)
            $.ajax({
                url:backendURL,
                method:'post',
                data:{action:'update-post', title, content, user_id, post_id},
                dataType:"json",
                success:function(data) { 
                    alert(data.msg);
                    location.reload();
                }
            })
        })
    } else if($("body").attr("id") == 'my-posts') {
        let user_id = parseInt($("#user_id").text());
        $.ajax({
            url:backendURL,
            method:'get',
            data:{action:'my-posts', user_id},
            dataType:"json",
            success:function(data) {
                console.log(data)
                // if(data.status != '200') {
                //     $("#edit-post").html("Post not found");
                // } else {
                //     $("#title").val(data.data[0].title)
                //     $("#content").val(data.data[0].content)
                // }

            }
        })



        $("#update-post").on("submit", function(e) {
            e.preventDefault();
            let title = $("#title").val();
            let content = $("#content").val();
            let user_id = $("#user_id").val();
            // console.log(title, content, user_id, post_id)
            $.ajax({
                url:backendURL,
                method:'post',
                data:{action:'update-post', title, content, user_id, post_id},
                dataType:"json",
                success:function(data) {
                    alert(data.msg);
                    location.reload();
                }
            })
        })
    }
})