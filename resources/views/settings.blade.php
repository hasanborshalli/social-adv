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
          <livewire:profile-settings />
        </div>

        <!-- ========== Account ========== -->
        <div class="tab-pane fade" id="panel-set-account" role="tabpanel" aria-labelledby="tab-set-account" tabindex="0">
          <livewire:account-settings />
        </div>

        <!-- ========== Privacy ========== -->
        <div class="tab-pane fade" id="panel-set-privacy" role="tabpanel" aria-labelledby="tab-set-privacy" tabindex="0">
          <livewire:privacy-settings />
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
