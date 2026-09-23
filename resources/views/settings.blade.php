<x-layouts.app title="Settings · YouBee Social">
  <h1 class="h4 mb-3">Settings &amp; privacy</h1>

  <div class="row g-3">

    <!-- ===== Settings sections ===== -->
    <div class="col-12 col-md-4 col-xl-3">
      <div class="card">
        <div class="card-body">
          <nav class="nav flex-column settings-nav" role="tablist" aria-label="Settings sections">
            <button class="nav-link active" id="tab-set-profile" data-bs-toggle="pill" data-bs-target="#panel-set-profile"
                    type="button" role="tab" aria-controls="panel-set-profile" aria-selected="true">
              <i class="bi bi-person" aria-hidden="true"></i><span>Profile</span>
            </button>
            <button class="nav-link" id="tab-set-account" data-bs-toggle="pill" data-bs-target="#panel-set-account"
                    type="button" role="tab" aria-controls="panel-set-account" aria-selected="false">
              <i class="bi bi-person-badge" aria-hidden="true"></i><span>Account</span>
            </button>
            <button class="nav-link" id="tab-set-privacy" data-bs-toggle="pill" data-bs-target="#panel-set-privacy"
                    type="button" role="tab" aria-controls="panel-set-privacy" aria-selected="false">
              <i class="bi bi-lock" aria-hidden="true"></i><span>Privacy</span>
            </button>
            <button class="nav-link" id="tab-set-notifications" data-bs-toggle="pill" data-bs-target="#panel-set-notifications"
                    type="button" role="tab" aria-controls="panel-set-notifications" aria-selected="false">
              <i class="bi bi-bell" aria-hidden="true"></i><span>Notifications</span>
            </button>
            <button class="nav-link" id="tab-set-blocking" data-bs-toggle="pill" data-bs-target="#panel-set-blocking"
                    type="button" role="tab" aria-controls="panel-set-blocking" aria-selected="false">
              <i class="bi bi-slash-circle" aria-hidden="true"></i><span>Blocking</span>
            </button>
          </nav>
        </div>
      </div>
    </div>

    <!-- ===== Panels ===== -->
    <div class="col-12 col-md-8 col-xl-9">
      <div class="tab-content">

        <!-- ========== Profile ========== -->
        <div class="tab-pane fade show active" id="panel-set-profile" role="tabpanel" aria-labelledby="tab-set-profile" tabindex="0">
          <form class="card" action="#" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <h2 class="h5 mb-1">Profile</h2>
              <p class="text-secondary small mb-4">This is what people see when they open your profile.</p>

              <div class="setting-row">
                <div class="setting-row__text">
                  <p class="fw-semibold mb-0">Profile picture</p>
                  <p class="text-secondary small mb-0">Square images look best.</p>
                </div>
                <div class="setting-row__control d-flex align-items-center gap-3">
                  <img class="avatar avatar-xl" src="{{ auth()->user()->profile_picture_url }}" alt="Your current profile picture">
                  <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">Change</button>
                </div>
              </div>

              <div class="setting-row">
                <div class="setting-row__text">
                  <p class="fw-semibold mb-0">Cover photo</p>
                  <p class="text-secondary small mb-0">Always public. 1600 × 500 px or larger.</p>
                </div>
                <div class="setting-row__control d-flex align-items-center gap-3">
                  <img class="rounded object-fit-cover" src="{{ auth()->user()->cover_photo_url }}" alt="Your current cover photo" width="120" height="38">
                  <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#changeCoverModal">Change</button>
                </div>
              </div>

              <hr class="my-4">

              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setName">Display name</label>
                  <input type="text" class="form-control" id="setName" name="name" value="Hasan Nahleh" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setUsername">Username</label>
                  <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="setUsername" name="username" value="hasann"
                           pattern="[a-zA-Z0-9_.]{3,30}" required>
                  </div>
                  <div class="form-text">Letters, numbers, dots and underscores. 3–30 characters.</div>
                </div>

                <div class="col-12">
                  <label class="form-label" for="setBio">Bio</label>
                  <textarea class="form-control" id="setBio" name="bio" rows="3" maxlength="160">Designing calmer software. Bikes, film cameras, and too many notebooks.</textarea>
                  <div class="form-text">Up to 160 characters.</div>
                </div>

                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setWork">Work</label>
                  <input type="text" class="form-control" id="setWork" name="work" value="Product designer at Hivework">
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setEducation">Education</label>
                  <input type="text" class="form-control" id="setEducation" name="education" value="Central Saint Martins">
                </div>

                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setCity">Current city</label>
                  <input type="text" class="form-control" id="setCity" name="city" value="Manchester, UK">
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setWebsite">Website</label>
                  <input type="url" class="form-control" id="setWebsite" name="website" value="https://hasann.design">
                </div>

                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setBirthday">Birthday</label>
                  <input type="date" class="form-control" id="setBirthday" name="birthday" value="1993-04-22">
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setPronouns">Pronouns</label>
                  <input type="text" class="form-control" id="setPronouns" name="pronouns" placeholder="e.g. they/them">
                </div>
              </div>
            </div>

            <div class="card-footer bg-transparent d-flex justify-content-end gap-2 py-3">
              <button class="btn btn-light" type="reset">Cancel</button>
              <button class="btn btn-primary px-4" type="submit">Save changes</button>
            </div>
          </form>
        </div>

        <!-- ========== Account ========== -->
        <div class="tab-pane fade" id="panel-set-account" role="tabpanel" aria-labelledby="tab-set-account" tabindex="0">

          <form class="card mb-3" action="#" method="post">
            <div class="card-body">
              <h2 class="h5 mb-1">Account</h2>
              <p class="text-secondary small mb-4">Contact details and regional preferences.</p>

              <div class="row g-3">
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setEmail">Email address</label>
                  <input type="email" class="form-control" id="setEmail" name="email" value="hasan@example.com" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setPhone">Mobile number</label>
                  <input type="tel" class="form-control" id="setPhone" name="phone" value="+44 7700 900123">
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end gap-2 py-3">
              <button class="btn btn-primary px-4" type="submit">Save changes</button>
            </div>
          </form>

          <form class="card mb-3" action="#" method="post">
            <div class="card-body">
              <h2 class="h6 mb-3">Change password</h2>
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label" for="setCurrentPw">Current password</label>
                  <input type="password" class="form-control" id="setCurrentPw" name="current_password" autocomplete="current-password" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setNewPw">New password</label>
                  <input type="password" class="form-control" id="setNewPw" name="new_password" autocomplete="new-password" minlength="12" required>
                  <div class="form-text">At least 12 characters.</div>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label" for="setConfirmPw">Confirm new password</label>
                  <input type="password" class="form-control" id="setConfirmPw" name="confirm_password" autocomplete="new-password" minlength="12" required>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end gap-2 py-3">
              <button class="btn btn-primary px-4" type="submit">Update password</button>
            </div>
          </form>

          <section class="card border-danger-subtle" aria-labelledby="dangerZoneHeading">
            <div class="card-body">
              <h2 class="h6 text-danger mb-3" id="dangerZoneHeading">Delete account</h2>
              <div class="setting-row pt-0">
                <div class="setting-row__text">
                  <p class="fw-semibold mb-0">Delete account</p>
                  <p class="text-secondary small mb-0">Permanently removes your posts, photos and messages after 30 days.</p>
                </div>
                <div class="setting-row__control">
                  <button class="btn btn-outline-danger" type="button">Delete account</button>
                </div>
              </div>
            </div>
          </section>
        </div>

        <!-- ========== Privacy ========== -->
        <div class="tab-pane fade" id="panel-set-privacy" role="tabpanel" aria-labelledby="tab-set-privacy" tabindex="0">
          <form class="card" action="#" method="post">
            <div class="card-body">
              <h2 class="h5 mb-1">Privacy</h2>
              <p class="text-secondary small mb-4">Decide who can find you and see what you share.</p>

              <div class="setting-row pt-0">
                <div class="setting-row__text">
                  <label class="fw-semibold mb-0" for="privPosts">Who can see your future posts</label>
                  <p class="text-secondary small mb-0">This becomes the default audience in the post composer.</p>
                </div>
                <div class="setting-row__control">
                  <select class="form-select w-auto" id="privPosts" name="posts_audience">
                    <option selected>Public</option>
                    <option>Friends</option>
                    <option>Friends except…</option>
                    <option>Only me</option>
                  </select>
                </div>
              </div>

              <div class="setting-row">
                <div class="setting-row__text">
                  <label class="fw-semibold mb-0" for="privRequests">Who can send you friend requests</label>
                  <p class="text-secondary small mb-0">Limits who sees the Add friend button on your profile.</p>
                </div>
                <div class="setting-row__control">
                  <select class="form-select w-auto" id="privRequests" name="request_audience">
                    <option selected>Everyone</option>
                    <option>Friends of friends</option>
                  </select>
                </div>
              </div>

              <div class="setting-row">
                <div class="setting-row__text">
                  <p class="fw-semibold mb-0">Show when you're active</p>
                  <p class="text-secondary small mb-0">Friends see a green dot next to your name.</p>
                </div>
                <div class="setting-row__control form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="privActiveStatus" name="active_status" checked>
                  <label class="visually-hidden" for="privActiveStatus">Show when you're active</label>
                </div>
              </div>
            </div>

            <div class="card-footer bg-transparent d-flex justify-content-end gap-2 py-3">
              <button class="btn btn-primary px-4" type="submit">Save changes</button>
            </div>
          </form>
        </div>

        <!-- ========== Notifications ========== -->
        <div class="tab-pane fade" id="panel-set-notifications" role="tabpanel" aria-labelledby="tab-set-notifications" tabindex="0">
          <form class="card" action="#" method="post">
            <div class="card-body">
              <h2 class="h5 mb-1">Notifications</h2>
              <p class="text-secondary small mb-4">Choose how each kind of update reaches you.</p>

              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <caption class="visually-hidden">Notification delivery preferences by category</caption>
                  <thead>
                    <tr>
                      <th scope="col">Activity</th>
                      <th scope="col" class="text-center">Push</th>
                      <th scope="col" class="text-center">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" class="fw-normal">Likes on your posts</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifReactPush" checked>
                        <label class="visually-hidden" for="notifReactPush">Push notifications for likes</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifReactEmail">
                        <label class="visually-hidden" for="notifReactEmail">Email notifications for likes</label>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="fw-normal">Comments and replies</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifCommentPush" checked>
                        <label class="visually-hidden" for="notifCommentPush">Push notifications for comments</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifCommentEmail" checked>
                        <label class="visually-hidden" for="notifCommentEmail">Email notifications for comments</label>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="fw-normal">Friend requests</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifFriendPush" checked>
                        <label class="visually-hidden" for="notifFriendPush">Push notifications for friend requests</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifFriendEmail" checked>
                        <label class="visually-hidden" for="notifFriendEmail">Email notifications for friend requests</label>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="fw-normal">Direct messages</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifMsgPush" checked>
                        <label class="visually-hidden" for="notifMsgPush">Push notifications for messages</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifMsgEmail">
                        <label class="visually-hidden" for="notifMsgEmail">Email notifications for messages</label>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="fw-normal">Birthdays</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifBdayPush">
                        <label class="visually-hidden" for="notifBdayPush">Push notifications for birthdays</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifBdayEmail" checked>
                        <label class="visually-hidden" for="notifBdayEmail">Email notifications for birthdays</label>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="fw-normal">Product news from YouBee</th>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifNewsPush">
                        <label class="visually-hidden" for="notifNewsPush">Push notifications for product news</label>
                      </td>
                      <td class="text-center">
                        <input class="form-check-input" type="checkbox" id="notifNewsEmail">
                        <label class="visually-hidden" for="notifNewsEmail">Email notifications for product news</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <hr class="my-4">

              <div class="setting-row pt-0">
                <div class="setting-row__text">
                  <p class="fw-semibold mb-0">Pause all notifications</p>
                  <p class="text-secondary small mb-0">Nothing will reach you until the pause ends.</p>
                </div>
                <div class="setting-row__control">
                  <label class="visually-hidden" for="notifPause">Pause all notifications for</label>
                  <select class="form-select w-auto" id="notifPause" name="pause">
                    <option selected>Off</option>
                    <option>1 hour</option>
                    <option>8 hours</option>
                    <option>Until tomorrow</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="card-footer bg-transparent d-flex justify-content-end gap-2 py-3">
              <button class="btn btn-primary px-4" type="submit">Save changes</button>
            </div>
          </form>
        </div>

        <!-- ========== Blocking ========== -->
        <div class="tab-pane fade" id="panel-set-blocking" role="tabpanel" aria-labelledby="tab-set-blocking" tabindex="0">
          <section class="card" aria-labelledby="blockingHeading">
            <div class="card-body">
              <h2 class="h5 mb-1" id="blockingHeading">Blocking</h2>
              <p class="text-secondary small mb-4">
                Blocked people can't see your profile, message you or send you friend requests.
              </p>

              <form class="row g-2 align-items-end mb-4" action="#" method="post">
                <div class="col-12 col-sm">
                  <label class="form-label" for="blockName">Block someone</label>
                  <input type="text" class="form-control" id="blockName" name="block" placeholder="Type a name or username">
                </div>
                <div class="col-12 col-sm-auto">
                  <button class="btn btn-outline-danger w-100" type="submit">Block</button>
                </div>
              </form>

              <h3 class="h6 text-secondary mb-2">Blocked accounts</h3>
              <ul class="list-unstyled vstack gap-1 mb-0">
                <li class="d-flex align-items-center gap-3 p-2 rounded hover-surface">
                  <img class="avatar" src="{{ asset('assets/img/avatar-5.svg') }}" alt="">
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-block fw-semibold text-truncate">Spam Account</span>
                    <small class="text-secondary">Blocked <time datetime="2026-06-02">2 June 2026</time></small>
                  </span>
                  <button class="btn btn-sm btn-light" type="button">Unblock</button>
                </li>
                <li class="d-flex align-items-center gap-3 p-2 rounded hover-surface">
                  <img class="avatar" src="{{ asset('assets/img/avatar-7.svg') }}" alt="">
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-block fw-semibold text-truncate">Old Colleague</span>
                    <small class="text-secondary">Blocked <time datetime="2025-11-18">18 November 2025</time></small>
                  </span>
                  <button class="btn btn-sm btn-light" type="button">Unblock</button>
                </li>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

  <x-modals.change-avatar />
  <x-modals.change-cover />
</x-layouts.app>
