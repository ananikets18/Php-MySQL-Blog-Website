<?php session_start(); ?>
<?php include('./inc/header.php'); ?>
<div class="container" style="height: 100vh;">
  <main class="my-5">
    <h5 class="mb-3 fs-4">Did you like to write blogs ?</h5>
    <p class="text-muted mb-5">Here below are the some rules & regulation which much follow to maintain the
      comfortness while publishing your blog posts !!!</p>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Your Blog Post must be informative and useful!
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>Your Blog Post must be informative and useful!</strong>
            We are looking for experts who are excited to share their knowledge with others.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Your article must be 100% unique and well written
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong> Your article must be 100% unique and well written.</strong>
            We won’t accept thin content or an article that’s been published anywhere else – we check!!
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Low-Effort Posts
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Post titles and content need to show effort. Posts with only a title or a link will likely be
            removed at moderator discretion. Posts that could be easily researched will likely be removed at
            moderator discretion.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Spam & Promotions's Based
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            All submissions must be directly related to writing and contain enough information. Low-quality
            posts, especially those with only a link or title, obvious spam or site promotion,
            self-acknowledgement, and solicitations to do your work for you are more likely to get removed
            without warning.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            Use of CKEditor
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p><strong>All the users are requsted to use the rich text editor known as CKEditor</strong>
              which is more powerful & elegent and packed with most of features.</p>
          </div>
        </div>
      </div>
    </div>
  </main>


</div>
<?php include('./inc/footer.php'); ?>