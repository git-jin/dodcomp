

function copy_clipboard(text){
    if (window.clipboardData) {
		// Internet Explorer
        window.clipboardData.setData("Text", text);
		alert("���� �Ǿ����ϴ�.");
    }    else{
        /*
		unsafeWindow.netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        const clipboardHelper = Components.classes["@mozilla.org/widget/clipboardhelper;1"].getService(Components.interfaces.nsIClipboardHelper);
        clipboardHelper.copyString(text);
		*/
		prompt( "Ctrl+C�� ������ �����ϼ���." ,text );
    }
}


