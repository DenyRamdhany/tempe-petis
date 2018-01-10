package com.example.sofyan.tempepetis;

/**
 * Created by SamPuc on 12/22/2017.
 */

public class History {
    private String token,status,tanggal,nominal;

    public History() {}

    public History(String token, String tanggal, String nominal, String status)
    {   this.token = token;
        this.status = status;
        this.tanggal = tanggal;
        this.nominal = nominal;
    }

    public String getToken() {
        return token;
    }

    public String getStatus() {
        return status;
    }

    public String getTanggal() {
        return tanggal;
    }

    public String getNominal() {
        return nominal;
    }
}
