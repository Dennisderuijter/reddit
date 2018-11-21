$(document).ready(function () {
    var replyOnPost = "<a class='btn-reply' onClick='postReply(0)'>Reply</a>";
    $('.replyOnPost').html(replyOnPost);
	listComment(function() {
        console.log('all replies loaded in.');
        console.log(postId);
        oddEven();
    });
});

function postReply(commentId, i) {
    $('#frm-comment').remove();
    if (commentId == 0) {
        var parentDiv = $('.main-reply-box');
    } else {
        var parentDiv = i.parentNode.parentNode;
    }
    console.log(parentDiv);
    var form = '<form id="frm-comment"><div class="input-row"><input type="hidden" name="comment_id" id="commentId" /></div><div class="input-row"><textarea required class="input-field" type="text" name="comment" id="comment" placeholder="Add a Comment"></textarea></div><div><input type="button" class="btn-submit" id="submitButton" value="save" onClick="submitReply()" /></div></form>';
    $(parentDiv).append(form);
    $('#postId').val(postId);
    $('#commentId').val(commentId);
    $("#comment").focus();
}

function listComment(_callback) {
    $.post("backend/comment-list.php?postid="+postId, function (data) {
        var data = JSON.parse(data);      
        var comments = "";
        var replies = "";
        var item = "";
        var parent = -1;
        var results = new Array();
        var list = $("<ul class='outer-comment'>");
        var item = $("<li>").html(comments);
        for (var i = 0; (i < data.length); i++) {
            var commentId = data[i]['id'];
            parent = data[i]['parent_id'];
            if (parent == "0") {
                comments = "<div class='comment-row'>"+
                "<div class='comment-info'><span class='comment-row-label'>from</span> <a href='u/user.php?u=" + data[i]['author'] + "'><span class='posted-by'>" + data[i]['author'] + " </span></a> <span class='comment-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
                "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                "<div><a class='btn-reply' onClick='postReply(" + commentId +",this);'>Reply</a></div>"+
                "<div class='reply-box'></div>"+
                "</div>";
                var item = $("<li>").html(comments);
                list.append(item);
                var reply_list = $('<ul class="first-replies">');
                item.append(reply_list);
                listReplies(commentId, data, reply_list);
            }
        }
        $("#output").html(list);
        _callback();
    });
}

function listReplies(commentId, data, list) {
    for (var i = 0; (i < data.length); i++) {
        if (commentId == data[i].parent_id) {
            var comments = "<div class='comment-row'>"+
            "<div class='comment-info'><span class='comment-row-label'>from</span> <a href='u/user.php?u=" + data[i]['author'] + "'><span class='posted-by'>"+ data[i]['author'] + " </span></a> <span class='comment-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
            "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
            "<div><a class='btn-reply' onClick='postReply(" + data[i]['id'] + ",this);'>Reply</a></div>"+
            "<div class='reply-box'></div>"+
            "</div>";
            var item = $("<li>").html(comments);
            var reply_list = $('<ul>');
            list.append(item);
            item.append(reply_list);
            listReplies(data[i].id, data, reply_list);
            if (reply_list.is(':empty')) {
                reply_list.remove();
            }
        }
    }
}

function oddEven() {
    $('li').each(function() {
        if ($(this).parent().hasClass("first-replies")) {
            $(this).addClass("odd");
        } else {
            if ($(this).parent().parent().hasClass("odd")) {
                $(this).addClass("even");
            } else {
                $(this).addClass("odd");
            }
        } 
    });
}

function submitReply() {
    $("#comment-message").css('display', 'none');
    var str = $("#frm-comment").serialize();
    $.ajax({
        url: "backend/comment-add.php?postid="+postId,
        data: str,
        type: 'post',
        success: function (response) {
            var result = eval('(' + response + ')');
            if (response) {
                $("#comment-message").css('display', 'inline-block');
                $("#comment").val("");
                $("#commentId").val("");
                listComment(function() {
                    console.log('all replies loaded in.');
                    oddEven();
                });
            } else {
                console.log("Failed to add comment!");
                return false;
            }
        }
    });
}