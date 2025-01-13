<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Turkish language strings for local_usrctr
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Plugin strings
$string['pluginname'] = 'Kullanıcı Sayacı';
$string['pluginname_desc'] = 'Kullanıcı Sayacı eklentisi, Moodle sitenizde kullanıcı sayısını takip etmenizi ve sınırlamanızı sağlar.';

// Settings strings
$string['settings'] = 'Kullanıcı Sayacı Ayarları';
$string['userlimit'] = 'Kullanıcı limiti';
$string['userlimit_desc'] = 'Sistemde izin verilen maksimum kullanıcı sayısı';
$string['userlimitdesc'] = 'Moodle sitenizde izin verilen maksimum aktif kullanıcı sayısını belirleyin';
$string['include_suspended'] = 'Askıya alınmış kullanıcıları dahil et';
$string['include_suspended_desc'] = 'Etkinleştirilirse, askıya alınmış kullanıcılar kullanıcı limitine dahil edilecektir';
$string['include_deleted'] = 'Silinmiş kullanıcıları dahil et';
$string['include_deleted_desc'] = 'Etkinleştirilirse, silinmiş kullanıcılar kullanıcı limitine dahil edilecektir';

// Error messages
$string['error'] = 'Hata';
$string['error_limit_reached'] = 'Kullanıcı limitine ulaşıldı. Lütfen yöneticinizle iletişime geçin.';
$string['error_upload_limit'] = 'Kullanıcılar yüklenemiyor: kullanıcı limiti aşılacak.';
$string['userlimitexceeded'] = 'Kullanıcı limiti aşıldı. Mevcut kullanıcı: {$a->current}, Limit: {$a->limit}';
$string['userlimitexceeded_title'] = 'Kullanıcı Limiti Aşıldı';
$string['userlimitexceeded_upload'] = 'Kullanıcı limiti aşıldı. Sadece mevcut kullanıcıları güncelleyebilirsiniz.';

// Status messages
$string['status_active'] = 'Aktif';
$string['status_suspended'] = 'Askıya Alınmış';
$string['status_deleted'] = 'Silinmiş';
$string['total_users'] = 'Toplam Kullanıcı';
$string['remaining_slots'] = 'Kalan Kontenjan';

// Capability strings
$string['usrctr:manage'] = 'Kullanıcı sayacı ayarlarını yönet';
$string['usrctr:view'] = 'Kullanıcı sayacı istatistiklerini görüntüle';

// Privacy
$string['privacy:metadata'] = 'Kullanıcı Sayacı eklentisi hiçbir kişisel veri saklamaz.';
