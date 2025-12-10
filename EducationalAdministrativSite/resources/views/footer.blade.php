<footer class="main-footer">
    <div class="container">

        <div class="row footer-sections">

            <div class="col-md-3 footer-column">
                <h5>School of Business</h5> 
                <ul>
                    <li><a href="{{ url('/courses/bba') }}">BBA (Hons) Business and Management</a></li>
                    <li><a href="{{ url('/courses/weekend-mba') }}">Weekend MBA (Executive)</a></li>
                    <li><a href="{{ url('/courses/mba') }}">MBA (Graduate)</a></li>
                    <li><a href="{{ url('/courses/hm') }}">HM (Hospitality Management)</a></li>
                    <li><a href="{{ url('/courses/acca') }}">ACCA Programme</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-column">
                <h5>School of Computing</h5>
                <ul>
                    <li><a href="{{ url('/courses/bsc-computing') }}">BSc (Hons) Computing</a></li>
                    <li><a href="{{ url('/courses/cyber-security') }}">BSc Cyber Security & Digital Forensics</a></li>
                    <li><a href="{{ url('/courses/data-science') }}">BSc Data Science</a></li>
                    <li><a href="{{ url('/courses/ai') }}">BSc Computer Science – AI</a></li>
                    <li><a href="{{ url('/courses/msc-it') }}">MSc Information Technology</a></li>
                    <li><a href="{{ url('/courses/msc-acs') }}">MSc Advanced Computer Science</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-column">
                <h5>Cambridge A-Level Programme</h5>
                <ul>
                    <li><a href="{{ url('/a-level') }}">GCE A Level</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-column">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/blogs') }}">Blogs</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ url('/downloads') }}">Downloads</a></li>
                    <li><a href="{{ url('/jobs') }}">Jobs at TBC</a></li>
                </ul>
            </div>

        </div>

        <div class="newsletter">
            <h5>Subscribe Newsletter</h5>
            <form action="{{ url('/subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Your Email Address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>

        <div class="social-icons">
            <a href="https://facebook.com" target="_blank">f</a>
            <a href="https://twitter.com" target="_blank">t</a>
            <a href="https://linkedin.com" target="_blank">in</a>
            <a href="https://youtube.com" target="_blank">yt</a>
            <a href="https://instagram.com" target="_blank">ig</a>
        </div>

    </div>
</footer>
