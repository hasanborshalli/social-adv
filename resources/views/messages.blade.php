<x-layouts.app title="Messages · YouBee Social">
  <h1 class="visually-hidden">Messages</h1>

  <div class="card full-height-panel overflow-hidden">
    <div class="row g-0 h-100 flex-nowrap">

      <!-- ===== Conversation list (drawer on phones, column from md up) ===== -->
      <div class="col-md-5 col-lg-4 border-end h-100 message-list">
        <div class="offcanvas-md offcanvas-start h-100" role="dialog" tabindex="-1" id="conversationDrawer"
          aria-labelledby="conversationDrawerLabel">

          <div class="offcanvas-header border-bottom">
            <h2 class="offcanvas-title h6 mb-0" id="conversationDrawerLabel">Chats</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#conversationDrawer"
              aria-label="Close"></button>
          </div>

          <div class="offcanvas-body">

            <div class="p-3 border-bottom">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="h6 mb-0 d-none d-md-block">Chats</h2>
                <button class="btn btn-sm btn-primary ms-auto" type="button" data-bs-toggle="modal"
                  data-bs-target="#newMessageModal">
                  <i class="bi bi-pencil-square me-1" aria-hidden="true"></i>New
                </button>
              </div>
              <form role="search" action="#" method="get">
                <label class="visually-hidden" for="chatSearch">Search conversations</label>
                <input type="search" class="form-control form-control-sm rounded-pill" id="chatSearch" name="q"
                  placeholder="Search Messenger">
              </form>
            </div>

            <div class="flex-grow-1 overflow-auto p-2">
              <ul class="list-group list-group-flush conversation-list mb-0">

                <li class="list-group-item active d-flex align-items-center gap-2" aria-current="true">
                  <span class="presence presence--online">
                    <img class="avatar" src="{{ asset('assets/img/avatar-3.svg') }}" alt=""><span
                      class="presence__dot"></span>
                  </span>
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <span class="fw-semibold text-truncate">Maysam Chaalan</span>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-14T10:24">10:24</time></small>
                    </span>
                    <span class="d-block small text-secondary text-truncate">Sounds good — see you at the studio!</span>
                  </span>
                </li>

                <li class="list-group-item d-flex align-items-center gap-2 hover-surface position-relative">
                  <span class="presence presence--online">
                    <img class="avatar" src="{{ asset('assets/img/avatar-2.svg') }}" alt=""><span
                      class="presence__dot"></span>
                  </span>
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <a class="fw-semibold text-truncate text-body text-decoration-none stretched-link" href="#">Ali
                        Nahleh</a>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-14T09:51">09:51</time></small>
                    </span>
                    <span class="d-block small fw-semibold text-truncate">Sent you 2 photos</span>
                  </span>
                  <span class="unread-dot flex-shrink-0" aria-hidden="true"></span>
                  <span class="visually-hidden">Unread</span>
                </li>

                <li class="list-group-item d-flex align-items-center gap-2 hover-surface position-relative">
                  <img class="avatar" src="{{ asset('assets/img/avatar-4.svg') }}" alt="">
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <a class="fw-semibold text-truncate text-body text-decoration-none stretched-link" href="#">Ali
                        Ayoub</a>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-14T08:12">08:12</time></small>
                    </span>
                    <span class="d-block small fw-semibold text-truncate">Can you review the spec today?</span>
                  </span>
                  <span class="unread-dot flex-shrink-0" aria-hidden="true"></span>
                  <span class="visually-hidden">Unread</span>
                </li>

                <li class="list-group-item d-flex align-items-center gap-2 hover-surface position-relative">
                  <span class="presence presence--away">
                    <img class="avatar" src="{{ asset('assets/img/avatar-7.svg') }}" alt=""><span
                      class="presence__dot"></span>
                  </span>
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <a class="fw-semibold text-truncate text-body text-decoration-none stretched-link" href="#">Elias
                        Al Omar</a>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-13">Yest.</time></small>
                    </span>
                    <span class="d-block small text-secondary text-truncate">You: I'll bring the tripod</span>
                  </span>
                </li>

                <li class="list-group-item d-flex align-items-center gap-2 hover-surface position-relative">
                  <img class="avatar" src="{{ asset('assets/img/avatar-8.svg') }}" alt="">
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <a class="fw-semibold text-truncate text-body text-decoration-none stretched-link"
                        href="#">Haitham Ismail</a>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-11">Fri</time></small>
                    </span>
                    <span class="d-block small text-secondary text-truncate">You: 😂 fair enough</span>
                  </span>
                </li>

                <li class="list-group-item d-flex align-items-center gap-2 hover-surface position-relative">
                  <img class="avatar" src="{{ asset('assets/img/avatar-5.svg') }}" alt="">
                  <span class="flex-grow-1 min-w-0">
                    <span class="d-flex justify-content-between gap-2">
                      <a class="fw-semibold text-truncate text-body text-decoration-none stretched-link" href="#">Elie
                        Amin</a>
                      <small class="text-secondary flex-shrink-0"><time datetime="2026-09-09">Wed</time></small>
                    </span>
                    <span class="d-block small text-secondary text-truncate">Thanks for the intro!</span>
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== Active thread ===== -->
      <div class="col-12 col-md-7 col-lg-8 d-flex flex-column h-100">

        <header class="d-flex align-items-center gap-2 p-2 p-sm-3 border-bottom">
          <button class="btn btn-light d-md-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#conversationDrawer" aria-controls="conversationDrawer" aria-label="Show conversations">
            <i class="bi bi-list" aria-hidden="true"></i>
          </button>

          <a class="d-flex align-items-center gap-2 text-decoration-none text-body min-w-0 flex-grow-1"
            href="{{ route('profile') }}">
            <span class="presence presence--online">
              <img class="avatar" src="{{ asset('assets/img/avatar-3.svg') }}" alt=""><span
                class="presence__dot"></span>
            </span>
            <span class="min-w-0">
              <span class="d-block fw-semibold text-truncate">Maysam Chaalan</span>
              <small class="text-success">Active now</small>
            </span>
          </a>

          <div class="dropdown">
            <button class="icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
              aria-label="Conversation options">
              <i class="bi bi-info-circle" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
              <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"
                    aria-hidden="true"></i>View profile</a></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-search me-2" aria-hidden="true"></i>Search
                  in conversation</button></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-bell-slash me-2"
                    aria-hidden="true"></i>Mute notifications</button></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-slash-circle me-2"
                    aria-hidden="true"></i>Block</button></li>
            </ul>
          </div>
        </header>

        <div class="chat-scroll">

          <p class="text-center small text-secondary my-3">
            <time datetime="2026-09-14">Today</time>
          </p>

          <div class="msg msg--in">
            <img class="avatar avatar-sm align-self-end" src="{{ asset('assets/img/avatar-3.svg') }}"
              alt="Maysam Chaalan">
            <div>
              <div class="msg__bubble">Morning! Did the swatches arrive?</div>
              <div class="msg__meta mt-1"><time datetime="2026-09-14T09:02">09:02</time></div>
            </div>
          </div>

          <div class="msg msg--out">
            <div>
              <div class="msg__bubble">They did — all six. The amber is even better in print than on screen.</div>
              <div class="msg__meta mt-1 text-end"><time datetime="2026-09-14T09:05">09:05</time> · Seen</div>
            </div>
          </div>

          <div class="msg msg--out">
            <div>
              <div class="msg__bubble p-1 overflow-hidden">
                <img class="rounded" src="{{ asset('assets/img/photo-1.svg') }}"
                  alt="Amber swatch photographed on a desk" width="240">
              </div>
              <div class="msg__meta mt-1 text-end"><time datetime="2026-09-14T09:06">09:06</time></div>
            </div>
          </div>

          <div class="msg msg--in">
            <img class="avatar avatar-sm align-self-end" src="{{ asset('assets/img/avatar-3.svg') }}"
              alt="Maysam Chaalan">
            <div>
              <div class="msg__bubble">Oh that's gorgeous. Can we get it on the cover stock too?</div>
              <div class="msg__meta mt-1"><time datetime="2026-09-14T09:11">09:11</time></div>
            </div>
          </div>

          <div class="msg msg--out">
            <div>
              <div class="msg__bubble">Already ordered. Should land Thursday.</div>
              <div class="msg__meta mt-1 text-end"><time datetime="2026-09-14T10:20">10:20</time> · Seen</div>
            </div>
          </div>

          <div class="msg msg--in">
            <img class="avatar avatar-sm align-self-end" src="{{ asset('assets/img/avatar-3.svg') }}"
              alt="Maysam Chaalan">
            <div>
              <div class="msg__bubble">Sounds good — see you at the studio!</div>
              <div class="msg__meta mt-1"><time datetime="2026-09-14T10:24">10:24</time></div>
            </div>
          </div>

          <div class="msg msg--in">
            <img class="avatar avatar-sm align-self-end" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
            <div class="msg__bubble py-2">
              <span class="typing" role="status" aria-label="Maysam Chaalan is typing">
                <span></span><span></span><span></span>
              </span>
            </div>
          </div>
        </div>

        <form class="d-flex align-items-end gap-1 gap-sm-2 p-2 p-sm-3 border-top" action="#" method="post"
          enctype="multipart/form-data">
          <div class="position-relative">
            <button class="icon-btn" type="button" aria-label="Attach a photo"><i class="bi bi-image"
                aria-hidden="true"></i></button>
            <label class="visually-hidden" for="chatAttachment">Attach a photo</label>
            <input class="position-absolute top-0 start-0 w-100 h-100 opacity-0" type="file" id="chatAttachment"
              name="attachment" accept="image/*">
          </div>
          <button class="icon-btn d-none d-sm-inline-flex" type="button" aria-label="Attach a file"><i
              class="bi bi-paperclip" aria-hidden="true"></i></button>

          <label class="visually-hidden" for="chatInput">Write a message to Maysam Chaalan</label>
          <textarea class="form-control rounded-4" id="chatInput" name="message" rows="1"
            placeholder="Write a message…"></textarea>

          <button class="icon-btn d-none d-sm-inline-flex" type="button" aria-label="Add an emoji"><i
              class="bi bi-emoji-smile" aria-hidden="true"></i></button>
          <button class="btn btn-primary rounded-circle btn-icon" type="submit" aria-label="Send message">
            <i class="bi bi-send-fill" aria-hidden="true"></i>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- ===================== New message dialog ===================== -->
  <div class="modal fade" role="dialog" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" action="#" method="post">
        <div class="modal-header">
          <h2 class="modal-title h5" id="newMessageLabel">New message</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" for="messageTo">To</label>
            <input type="text" class="form-control" id="messageTo" name="to" list="friendNames"
              placeholder="Type a name" autocomplete="off" required>
            <datalist id="friendNames">
              <option value="Ali Nahleh"></option>
              <option value="Maysam Chaalan"></option>
              <option value="Elias Al Omar"></option>
              <option value="Haitham Ismail"></option>
              <option value="Ali Ayoub"></option>
              <option value="Elie Amin"></option>
              <option value="Baqer Alayyan"></option>
            </datalist>
          </div>

          <div>
            <label class="form-label" for="messageBody">Message</label>
            <textarea class="form-control" id="messageBody" name="body" rows="3" placeholder="Say hello…"
              required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary px-4">Send</button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.app>