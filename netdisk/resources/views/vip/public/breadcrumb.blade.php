<div class="breadcrumbs">
    <div class="container clr">
        <div class="header-search">
            <form method="get" id="searchform" class="searchform" action="http://www.lmonkey.com" role="search">
                <input type="search" class="field" name="s" value="" id="s" placeholder="Search" required="" />
                <button type="submit" class="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div id="breadcrumbs">
            <h1><i class="fa fa-folder-open"></i> 分类文章</h1>
            <div class="breadcrumbs-text">
                <a href="{{ url('lists/'.$cateid) }}" title="{{ $catename }}">主页</a>&nbsp;&raquo;&nbsp;{{ $catename }}
            </div>
        </div>
    </div>
</div>