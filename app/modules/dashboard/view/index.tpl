{if $user && !$user->isEmailVerified() && (time() > strtotime($user->getVerificationCodeExpire()))}
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Ваш адрес электронной почты не подтвержден.</p>
                <p>Для подтверждения адреса электронной почты пройдите по ссылке из письма, отправленного после регистрации на адрес электронной почты <span class="text-nowrap">«{$user->getEmail()}».</span></p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <button class="btn btn-inverse-warning w-100 verifyEmail">Отправить письмо еще раз</button>
            </div>
        </div>
    </div>
{/if}

{* if $user && !$user->isPhoneVerified()}
    <div class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Ваш мобильный телефон не подтвержден.</p>
                <p>Введите код, который мы сообщим Вам на мобильный телефон <span class="text-nowrap">«{Valid::internationalPhone($user->getPhone(), $user->getCountryCode())}».</span></p>
            </div>
            <div class="col-auto ms-auto">
                <button class="btn btn-inverse-warning verifyPhone">Отправить код подтверждения</button>
            </div>
        </div>
    </div>
{/if *}

{if $user && (!$user->getFirstname() || !$user->getLastname() || !$user->getPatronymic())}
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Ваш профиль не заполнен.</p>
                <p>Для верификации профиля необходимо корректно заполнить ФИО.</p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <a class="btn btn-inverse-warning w-100" href="{$ABS_PATH}profile">Перейти в профиль</a>
            </div>
        </div>
    </div>
{/if}

{if $organization && (!$organization->getCertificate() || !$organization->getFgisToken() || empty($organization->getAutoPublishIds()))}
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Автоматическая публикация данных о поверке не настроена.</p>
                <p>Для автоматической публикации данных о поверке во ФГИС «Аршин» необходимо выбрать сертификат ЭЦП, ввести токен API и указать метрологов, чьи результаты поверок будут публиковаться автоматически.</p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <a class="btn btn-inverse-warning w-100" href="{$ABS_PATH}publication">Перейти в настройки</a>
            </div>
        </div>
    </div>
{/if}

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Доступность сервисов Аршин <span id="fgisStatus">{if $fgis_available}<i class="mdi mdi-check-circle text-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                              data-bs-title="Доступен"></i>{else}<i class="mdi mdi-close-circle text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                                                                    data-bs-title="Не доступен"></i>{/if}</span></h6>
            </div>
            <div class="card-body pt-0">
                <div id="fgisHeatmap"></div>
            </div>
        </div>
    </div>
</div>

{if $smarty.const.USERID == '00000000-0000-0000-0000-000000000000'}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">{#dashboard_title_visits#}</h6>
                </div>
                <div class="card-body">
                    <div id="dailyVisitsChart" data-chart='{$visits}' data-series="{#dashboard_title_visits#}"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">{#dashboard_title_storage#}</h6>
                </div>
                <div class="card-body">
                    <div id="storageChart" class="mx-auto position-relative" style="width: 200px; height: 200px;" data-usage="{$storage_usage.usage}"></div>
                    <div class="row mt-4 mb-3">
                        <div class="col-6 d-flex justify-content-end">
                            <div>
                                <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-normal">{#dashboard_storage_size#} <span class="p-1 ms-1 rounded-circle bg-primary"></span></label>
                                <h5 class="fw-bold mb-0 text-end">{Number::formatSize($storage_size)}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="d-flex align-items-center tx-10 text-uppercase fw-normal"><span class="p-1 me-1 rounded-circle bg-danger"></span> {#dashboard_storage_used#}</label>
                                <h5 class="fw-bold mb-0">{Number::formatSize($storage_usage.size)}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">{#dashboard_title_storage_details#}</h6>
                </div>
                <div class="card-body">
                    {foreach from=$storage_usage.details key=key item=item name=foo}
                        <div class="row py-2 bg-highlight-hover {if !$smarty.foreach.foo.last} border-bottom {/if}">
                            <div class="col">{#$key#}</div>
                            <div class="col text-end">{Number::formatSize($item)}</div>
                        </div>
                    {/foreach}
                </div>
                <div class="card-footer text-center pb-1">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <a id="backupDB"
                               {if Permissions::has('dashboard_backup_db')}href="{$ABS_PATH}dashboard/backup_db"{/if}
                               class="btn w-100 btn-outline-success mb-2 {if !Permissions::has('dashboard_backup_db')}disabled{/if}">{#dashboard_make_db_backup#}</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a id="clearCache"
                               {if Permissions::has('dashboard_clear_cache')}href="{$ABS_PATH}dashboard/clear_cache"{/if}
                               class="btn w-100 btn-outline-danger mb-2 {if !Permissions::has('dashboard_clear_cache')}disabled{/if}">{#dashboard_clear_cache#}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <form method="post" action="{$ABS_PATH}dashboard/generate">
                    <div class="card-header">
                        <h6 class="card-title mb-0">{#dashboard_generate_module#}</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <label class="form-label">{#dashboard_module_name#}</label>
                            <input value="" name="module" type="text" class="form-control" placeholder="{#dashboard_module_name#}" required>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">{#button_generate#}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/if}
