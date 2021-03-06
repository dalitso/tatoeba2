/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2011  HO Ngoc Phuong Trang <tranglich@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
function translationLink(action, sentenceId, translationId, langFilter)
{
    var rootUrl = get_tatoeba_root_url();

    // Show the loading gif...
    $('#link_' + sentenceId + '_' + translationId).html(
        "<img width='16' height='16' src='/img/loading.svg' alt='loading'>"
    );
    $("#_" + sentenceId + "_message").remove();

    $.post(
        rootUrl + "/links/" + action + "/" + sentenceId + "/" + translationId,
        {
            'returnTranslations': true,
            'langFilter' : langFilter
        },
        function(data){
            $("#_" + sentenceId + "_translations").replaceWith(data).show();
        },
        'html'
    );
}
