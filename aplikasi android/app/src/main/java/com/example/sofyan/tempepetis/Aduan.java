package com.example.sofyan.tempepetis;

/**
 * Created by SamPuc on 12/22/2017.
 */

public class Aduan {
    private String text,status;

    public Aduan() {}

    public Aduan(String text, String status)
    {   this.text = text;
        this.status = status;
    }

    public String getText() {
        return text;
    }
    public String getStatus() {
        return status;
    }
}
