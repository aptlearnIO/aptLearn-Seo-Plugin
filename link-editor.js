jQuery(document).ready(function($) {
    // Wait for the link editor to open
    $(document).on('wplink-open', function() {
        // Check if the nofollow checkbox already exists
        if ($('#wp-link-nofollow').length === 0) {
            // If not, add the nofollow checkbox
            $('#wp-link-target').after('<label><input type="checkbox" id="wp-link-nofollow"/> Add nofollow</label>');
        }
    });

    // When the link editor's Update button is clicked
    $(document).on('wplink-close', function() {
        // Get the nofollow checkbox value
        var nofollow = $('#wp-link-nofollow').is(':checked') ? 'nofollow' : '';

        // Get the existing rel attribute value
        var rel = $('#wp-link-rel').val();

        // If nofollow is checked, add it to the rel attribute value
        if (nofollow) {
            if (rel.indexOf('nofollow') === -1) {
                rel = rel ? rel + ' ' + nofollow : nofollow;
            }
        } else {
            // If nofollow is not checked, remove it from the rel attribute value
            rel = rel.replace('nofollow', '').trim();
        }

        // Set the new rel attribute value
        $('#wp-link-rel').val(rel);
    });
});
