<?php if (empty($results)) { ?>
    <div class="col-md-12 mt-3">
        <h6 class="text-center text-primer"><i>Ops... Agenda tidak ditemukan</i></h6>
    </div>
<?php } else { ?>
    <?php foreach ($results as $key => $v) { ?>
        <div class="col-md-6 single-note-item all-category">
            <div class="card card-body">
                <span class="side-stick"></span>
                <h5 class="note-title text-truncate w-75 mb-1" data-noteheading="Book a Ticket for Movie"> <?= $v["title"]; ?> </h5>
                <h6 class="note-title text-truncate w-75 mb-1" data-noteheading="Book a Ticket for Movie">
                    <span class="mb-1 badge text-primer bg-info-subtle"><?= $v["nama_lembaga"]; ?> (<?= $v["nama_singkat"]; ?>)</span>
                </h6>
                <p class="note-date fs-2">Start : <?= $v["start"]; ?> <br> End : <?= $v["end"]; ?></p>
                <p class="note-date fs-2"><b><?= $v["tempat_event"]; ?></b></p>
                <div class="align-items-center">
                    <button onclick="detailEvent('<?= $v['idevent']; ?>')" class="btn btn-sm text-white bg-warning">
                        <i class="ti ti-detail"></i> <i>Detail </i> Agenda
                    </button>
                    <!-- <div class="ms-auto">
                    <div class="category-selector btn-group">
                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                            <div class="category">
                                <div class="category-business"></div>
                                <div class="category-social"></div>
                                <div class="category-important"></div>
                                <span class="more-options text-dark">
                                    <i class="ti ti-dots-vertical fs-5"></i>
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right category-menu">
                            <a class="
                                  note-business
                                  badge-group-item badge-business
                                  dropdown-item
                                  position-relative
                                  category-business
                                  d-flex
                                  align-items-center
                                " href="javascript:void(0);">Business</a>
                            <a class="
                                  note-social
                                  badge-group-item badge-social
                                  dropdown-item
                                  position-relative
                                  category-social
                                  d-flex
                                  align-items-center
                                " href="javascript:void(0);"> Social</a>
                            <a class="
                                  note-important
                                  badge-group-item badge-important
                                  dropdown-item
                                  position-relative
                                  category-important
                                  d-flex
                                  align-items-center
                                " href="javascript:void(0);"> Important</a>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
<?php }
} ?>