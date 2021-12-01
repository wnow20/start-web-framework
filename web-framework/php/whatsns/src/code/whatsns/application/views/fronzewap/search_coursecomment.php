<!--{template meta}-->
    <style>
        body{
            background: #f1f5f8;
        }
        .relativecontent h2{
        margin:10px auto;
          padding-left:10px;
        }
    </style>

    <div class="ws_header">
        <i class="fa fa-home" onclick="window.location.href='{url index}'"></i>
        <div class="ws_h_title">{$setting['site_name']}</div>
        <i class="fa fa-search"  onclick="window.location.href='{url question/searchkey}'"></i>
    </div>

    <!--导航提示-->
    <div class="ws_s_au_brif">
         <span class="ws_s_au_bref_item "><a href="{url question/search/$word}">问题</a></span>

        <span class="ws_s_au_bref_item "><a href="{url topic/search}?word={$word}">文章</a></span>
        <span class="ws_s_au_bref_item"><a href="{url user/search}?word={$word}">用户</a></span>
        <span class="ws_s_au_bref_item"><a href="{url category/search}?word={$word}">话题</a></span>
<span class="ws_s_au_bref_item "><a href="{url kecheng/search}?word={$word}">课程</a></span>
<span class="ws_s_au_bref_item current"><a href="{url kecheng/searchcomment}?word={$word}">课程评论</a></span>

    </div>
   <!--列表部分-->
                    <div class="au_resultitems au_searchlist">
                        <!--{if $courseist}-->
  <div class="qlists">
        <div class="stream-list blog-stream">
      <!--{loop $courseist $nindex $course}-->

  <section class="stream-list__item">
              <div class="blog-rank stream__item">
              <div data-id="1190000017247505" class="stream__item-zan   btn btn-default mt0">
              <span class="stream__item-zan-icon"></span>
              <span onclick="followcourse({$course['id']})" class="stream__item-zan-number followcourse{$course['id']}" title="共{$course['followers']}人关注">{$course['followers']}</span>
              </div></div>
              <div class="summary">
              <h2 class="title blog-type-common blog-type-1">
              <a href="{eval echo config_item('course_url').'course/view/'.$course['id'];}">{$course['name']}</a></h2>
              <ul class="author list-inline">
              <li>
           
              <span style="vertical-align:middle;">
              <a href="{url user/space/$course['authorid']}"> {$course['author']}</a>
                    
                     
                                            </span>
                                                <span style="vertical-align:middle;margin-left:5px;">
          {$course['learners']}人学习
                    
                     
                                            </span>
                                            </li>
    </ul>
      <p class="excerpt wordbreak ">

                     {eval echo clearhtml($course['miaosu']);}
                 

  
  </p>
      </div>
      </section>

  <!--{/loop}-->
</div>
</div>
        <div class="pages">  {$departstr}</div>
   <!--{else}-->
                            <div id="no-result">
                <p>抱歉，未找到和您搜索相关的内容。</p>
                <strong>建议您：</strong>
                <ul class="nav">
                    <li><span>检查输入是否正确</span></li>
                    <li><span>简化查询词或尝试其他相关词</span></li>
                </ul>
            </div>
    <!--{/if}-->
   {eval  $questionlist=$this->getlistbysql("select id,title,author,time,answers,status,hidden from ".$this->db->dbprefix."question where title like '%{$word}%'  order by title desc   limit 0,10");}
        {if $questionlist}
<div class="relativecontent">

<h2>
相关问题
</h2>
       <div class="au_resultitems au_searchlist">
                      <!--{if $questionlist}-->
                         <div class="stream-list question-stream xm-tag tag-nosolve">
                        <!--{loop $questionlist $question}-->
                      
    
      <section class="stream-list__item">
       {if $question['status']==2}
                <div class="qa-rank"><div class="answers answered solved ml10 mr10">
                {$question['answers']}<small>解决</small></div></div>     
                {else}
                {if $question['answers']>0}
                <div class="qa-rank"><div class="answers answered ml10 mr10">
                $question['answers']<small>回答</small></div>
                </div>
                   {else}
                   <div class="qa-rank"><div class="answers ml10 mr10">
                0<small>回答</small></div></div>
                {/if}
                
                
                {/if}
                   <div class="summary">
            <ul class="author list-inline">
                                           
                                                <li class="authorinfo">
                                          {if $question['hidden']==1}
                                            匿名用户
                      
                       {else} 
                              <a href="{url user/space/$question['authorid']}">
                          {$question['author']}
                          </a>
                      
                         {/if} 
                       
                        <span class="split"></span>
                        <a href="{url question/view/$question['id']}">{$question['format_time']}</a>
                                    </li>
            </ul>
            <h2 class="title"><a href="{url question/view/$question['id']}">{$question['title']}</a></h2>
 
                
              
                                   
                           
                                            </div>
    </section>
   
  
 
      
     

                 <!--{/loop}-->
                  </div>
             
           
    <!--{/if}-->

                    </div>
<div class="text-center" style="margin-bottom:10px;">
     
      <ul class="pagination"><li class="next"><a rel="next" href="{url question/search}?word={$word}">查看更多</a></li></ul>
       </div>
</div>
{/if}
                    </div>
   <script>

   el2=$.tips({
        content:' 为您找到相关结果约{$rownum}个',
        stayTime:3000,
        type:"info"
    });
   </script>
      <script>
         $(".note-list em").addClass("search-result-highlight");
         /*关注课程*/
         function followcourse(cid) {
             if (g_uid == 0) {
                 login();
             }
          
             $.post(g_site_url + "index.php?kecheng/followercourse", {cid: cid}, function(msg) {
            
                 if (msg == 'ok1') {
                     
                     var _follownum=$(".followcourse"+cid).html();
                     $(".followcourse"+cid).html(parseInt(_follownum)-1);
                     alert("取消关注");
             
             }else if(msg == 'ok2'){
            	 var _follownum=$(".followcourse"+cid).html();
                 $(".followcourse"+cid).html(parseInt(_follownum)+1);
                   alert("关注成功");
             }
             else{
             	if(msg == '-1'){
             		alert("先登录在关注");
             	}else{
             		alert(msg);
             	}
             }
             });
         }
         </script>
<!--{template footer}-->