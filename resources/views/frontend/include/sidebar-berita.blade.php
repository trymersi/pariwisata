<div class="col-md-4">
    <div class="box-widget-wrap fl-wrap fixed-bar">
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Cari Pada Berita</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <div class="search-widget">
                        <form  class="fl-wrap" action="{{url('/pencarian-berita')}}">
                            <input name="pencarian" id="se" type="text" class="search" placeholder="Cari Berita" value="" />
                            <button class="search-submit color2-bg" id="submit_btn"><i class="fal fa-search"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->                                    
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Berita Populer</h3>
            </div>
            <div class="box-widget  fl-wrap">
                <div class="box-widget-content">
                    <!--widget-posts-->
                    <div class="widget-posts  fl-wrap">
                        <ul class="no-list-style">
                          @foreach($populer as $item)
                            <li>
                                <div class="widget-posts-img"><a href="{{ url('/berita/'.$item->slug) }}"><img src="{{ asset('uploads/images/gambar-berita/'.$item->thumbnail) }}" alt="{{ $item->title }}"></a></div>
                                <div class="widget-posts-descr">
                                    <h4><a href="{{ url('/berita/'.$item->slug) }}">{{ $item->title }}</a></h4>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> {{ tgl_indo($item->updated_at) }}</a></div>
                                </div>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                    <!-- widget-posts end-->
                </div>
            </div>
        </div>

        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Tags</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <div class="list-single-tags tags-stylwrap">
                      @foreach($label as $item)
                        <a href="#">{{ $item->nama }}</a>  
                      @endforeach                                                                           
                    </div>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->                                     
        <!--box-widget-item -->
        <div class="box-widget-item fl-wrap block_box">
            <div class="box-widget-item-header">
                <h3>Kategori Berita</h3>
            </div>
            <div class="box-widget fl-wrap">
                <div class="box-widget-content">
                    <ul class="cat-item no-list-style">
                      @foreach($kategori as $item)
                        <li><a href="{{ url('/kategori/'.$item->slug) }}">{{ $item->nama }}</a> <span>{{ $item->total_berita }}</span></li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--box-widget-item end -->                                   
    </div>
</div>