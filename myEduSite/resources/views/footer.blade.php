<footer class="main-footer">
    <div class="container">

        <div class="row footer-sections">

            <div class="col-md-3 footer-column">
                <h5>The Rose School</h5> 
                <ul>
                    <li><a href="{{ url('/courses/bba') }}">School of Art</a></li>
                    <li><a href="{{ url('/courses/weekend-mba') }}">School of Business</a></li>
                    <li><a href="{{ url('/courses/mba') }}">School of Finance</a></li>
                    <li><a href="{{ url('/courses/hm') }}">School of IT</a></li>
                    <li><a href="{{ url('/courses/acca') }}">School of Marketing</a></li>
                </ul>
            </div>
             <div class="col-md-3 footer-column">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/blogs') }}">Blogs</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ url('/courses') }}">Courses</a></li>
                    <li><a href="{{ url('/gallery') }}">Gallery</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-column">
                <h5>Contact</h5>
                <ul>
                    <li><a href="{{ url('contact') }}">Kathmandu, Nepal</a></li>
                    <li><a href="{{ url('contact') }}">+977 98000000</a></li>
                    <li><a href="{{ url('contact') }}">info@therosecollege</a></li>
                </ul>
            </div>
        </div>
<!-- 
        <div class="newsletter">
            <h5>Subscribe Newsletter</h5>
            <form action="{{ url('/subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Your Email Address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div> -->

        <div class="social-icons">
            <a href="https://facebook.com" target="_blank">f</a>
            <a href="https://twitter.com" target="_blank">t</a>
            <a href="https://linkedin.com" target="_blank">in</a>
            <a href="https://youtube.com" target="_blank">yt</a>
            <a href="https://instagram.com" target="_blank">ig</a>
        </div>
         <div class="footer-bottom">
    <p>© 2025 The Rose College. All Rights Reserved.</p>
  </div>

    </div>
</footer>
