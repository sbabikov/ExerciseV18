const SERVICE_PATH = 'geolocation';

class Validator {
    static onSubmit() {
        let startDate = new Date($("#start-date").val());
        let endDate = new Date($("#end-date").val());
        
        if (startDate.getTime() > endDate.getTime()) {
            this.showError('Start date must be less than end date');
            
            return false;
        }
        
        return true;
    }
    
    static showMessage(message) {
        $("#message").html(message);
    }
    
    static showError(error) {
        this.showMessage('<span class="error">ERROR: ' + error + '</span>');
    }
}

$(function() {
    $(".datepicker").datepicker({
        "dateFormat": "yy-mm-dd"
    });
});
