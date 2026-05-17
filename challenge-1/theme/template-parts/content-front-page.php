<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="travel-options">
        <ul>
            <li>Places to stay</li>
            <li>Monthly stays</li>
            <li>Experiences</li>
            <li>Online Experiences</li>
        </ul>
    </div>

    <div class="form-container">
        <form>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" placeholder="Where are you going?" />
            </div>

            <div class="form-group">
                <label for="dates">Check In / Check Out</label>
                <input type="text" id="dates" placeholder="Add Dates" />
            </div>

            <div class="form-group">
                <label for="guests">Guests</label>
                <input type="text" id="guests" placeholder="Add Guests" />
            </div>

             <button type="submit" class="submit-btn">Search</button>
        </form>
    </div>

    <div class="blm-container">
        <div class="blm-banner">
            <div class="blm-inner">
                <h2>We stand with #BlackLivesMatter</h2>        
                <p>Now more than ever, it's important that you know how we're fighting discrimination on Airbnb. We'd like to share our newest initiative with you, Project Lighthouse</p>
                <a class="blm-link" href="#">Learn More</a>
            </div>
        </div>
    </div>
        
</article>
