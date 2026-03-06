{{--
  ============================================================
  GLOBAL ADMIN PAGE TITLE STYLE
  Add this inside the <head> of your layouts/admin.blade.php
  ============================================================
--}}

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800;900&display=swap" rel="stylesheet">

<style>
  /*
   * Universal admin page header banner + title
   * Works for: .page-header h1, .ev-header h1, .admin-page-title
   * Use any of these classes on your banner/title across all pages.
   */

  /* Banner wrapper — red background strip */
  .page-header,
  .ev-header,
  .admin-header {
    background: #9B1B2A;
    padding: 26px 32px 22px;
    flex-shrink: 0;
  }

  /* H1 inside any banner — Poppins, bold, white, uppercase */
  .page-header h1,
  .ev-header h1,
  .admin-header h1,
  .admin-page-title {
    font-family: 'Poppins', sans-serif !important;
    font-size: 2rem;          /* h1 equivalent */
    font-weight: 900;
    color: #ffffff;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin: 0;
    line-height: 1.2;
  }
</style>

{{--
  ============================================================
  USAGE — in each page blade file use this pattern:

  <div class="page-header">
      <h1>DASHBOARD</h1>
  </div>

  <div class="page-header">
      <h1>MEMBERS</h1>
  </div>

  <div class="page-header">
      <h1>APPLICANT</h1>
  </div>

  <div class="page-header">
      <h1>ADMIN USERS</h1>
  </div>

  <div class="page-header">
      <h1>BOARD OF TRUSTEES</h1>
  </div>

  <div class="page-header">
      <h1>PCCI ACTIVITIES</h1>
  </div>

  <div class="page-header">
      <h1>EVENTS</h1>
  </div>
  ============================================================
--}}