<!--FOOTER BEGIN-->
@php
    $all_pages = \App\Page::all();
    $about_us_page = $all_pages->where('system_name', 'AboutUs')->first();
    $user_manual_page = $all_pages->where('system_name', 'UserManual')->first();
    $advertisement_page = $all_pages->where('system_name', 'Advertisement')->first();
    $contact_page = $all_pages->where('system_name', 'Contact')->first();
    $terms_of_use_page = $all_pages->where('system_name', 'TermsOfUse')->first();
    $privacy_policy_page = $all_pages->where('system_name', 'PrivacyPolicy')->first();
    $dmca_page = $all_pages->where('system_name', 'DMCA')->first();

@endphp


<footer class="trawell-footer">
    <div class="footer-widgets container">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4">
                <div id="nav_menu-2" class="widget widget_nav_menu">
                    <h5 class="widget-title h6">Giới thiệu</h5>
                    <div class="menu-footer-1-container">
                        <ul id="menu-footer-1" class="menu">
                            <li id="menu-item-454" class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                @if ($about_us_page != null)
                                    <a href="{{ url($about_us_page->slug) }}">Về chúng tôi</a>
                                @else
                                    <a href="#">Về chúng tôi</a>
                                @endif
                            </li>
                            <li id="menu-item-190" class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                @if ($user_manual_page != null)
                                    <a href="{{ url($user_manual_page->slug) }}">Hướng dẫn sử dụng</a>
                                @else
                                    <a href="#">Hướng dẫn sử dụng</a>
                                @endif
                            </li>
                            <li id="menu-item-187" class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                @if ($advertisement_page != null)
                                    <a href="{{ url($advertisement_page->slug) }}">Quảng cáo</a>
                                @else
                                    <a href="#">Quảng cáo</a>
                                @endif
                            </li>
                            <li id="menu-item-188" class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                @if ($contact_page != null)
                                    <a href="{{ url($contact_page->slug) }}">Liên hệ</a>
                                @else
                                    <a href="#">Liên hệ</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4">
                <div id="nav_menu-3" class="widget widget_nav_menu">
                    <h5 class="widget-title h6">Chính sách</h5>
                    <div class="menu-footer-2-container">
                        <ul id="menu-footer-2" class="menu">
                            <li id="menu-item-459" class="menu-item menu-item-type-post_type menu-item-object-page">
                                @if($terms_of_use_page != null)
                                    <a href="{{ url($terms_of_use_page->slug) }}">Điều khoản sử dụng</a>
                                @else
                                    <a href="#">Điều khoản sử dụng</a>
                                @endif
                            </li>
                            <li id="menu-item-455" class="menu-item menu-item-type-post_type menu-item-object-page">
                                @if($privacy_policy_page != null)
                                    <a href="{{ url($privacy_policy_page->slug) }}">Chính sách bảo mật</a>
                                @else
                                    <a href="#">Chính sách bảo mật</a>
                                @endif
                            </li>
                            <li id="menu-item-457" class="menu-item menu-item-type-post_type menu-item-object-page">
                                @if($dmca_page != null)
                                    <a href="{{ url($dmca_page->slug) }}">DMCA</a>
                                @else
                                    <a href="#">DMCA</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4">
                <div id="nav_menu-4" class="widget widget_nav_menu">
                    <h5 class="widget-title h6">Theo dõi chúng tôi</h5>
                    <div class="menu-footer-2-container">
                        <ul id="menu-footer-3" class="menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="https://www.facebook.com/Alodinet-105632648254353">Facebook</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="#">Youtube</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page ">
                                <a href="#">Twitter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
{{--            <div class="col-12 col-lg-3 col-md-4">--}}
{{--                <div id="custom_html-3" class="widget_text widget widget_custom_html">--}}
{{--                    <h5 class="widget-title h6">Newsletter</h5>--}}
{{--                    <div class="textwidget custom-html-widget">--}}
{{--                        <!-- Begin MailChimp Signup Form -->--}}
{{--                        <div id="mc_embed_signup" style="max-width:300px;">--}}
{{--                            <p>Make sure to subscribe to our newsletter and be the first to know the news.</p>--}}
{{--                            <form action="https://mekshq.us8.list-manage.com/subscribe/post?u=7b0c01faab4ec7b36214565c5&amp;id=2f153d325c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>--}}
{{--                                <div id="mc_embed_signup_scroll">--}}
{{--                                    <div class="mc-field-group">--}}
{{--                                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your email address">--}}
{{--                                    </div>--}}
{{--                                    <div id="mce-responses" class="clear">--}}
{{--                                        <div class="response" id="mce-error-response" style="display:none"></div>--}}
{{--                                        <div class="response" id="mce-success-response" style="display:none"></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->--}}
{{--                                    <div style="position: absolute; left: -5000px;" aria-hidden="true">--}}
{{--                                        <input type="text" name="b_7b0c01faab4ec7b36214565c5_2f153d325c" tabindex="-1" value="">--}}
{{--                                    </div>--}}
{{--                                    <div class="clear">--}}
{{--                                        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!--End mc_embed_signup-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</footer>

<!--FOOTER END-->
