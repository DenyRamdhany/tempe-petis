package com.example.sofyan.tempepetis;

import android.graphics.Color;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

/**
 * Created by SamPuc on 12/22/2017.
 */

public class AduanAdapter extends RecyclerView.Adapter<AduanAdapter.MyViewHolder> {

    private List<Aduan> data;

    public AduanAdapter(List<Aduan> data){this.data=data;}

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView text, status;

        public MyViewHolder(View view) {
            super(view);
            text   = (TextView) view.findViewById(R.id.line_a);
            status = (TextView) view.findViewById(R.id.line_b);
        }
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.listdata, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(AduanAdapter.MyViewHolder holder, int position) {
        Aduan adu = data.get(position);
        holder.text.setText(adu.getText());
        if(adu.getStatus().toString().equals("1")) {
            holder.status.setText("Ditanggapi");
            holder.status.setTextColor(Color.GREEN);
        }
        else {
            holder.status.setText("Belum Ditanggapi");
            holder.status.setTextColor(Color.RED);
        }
//        holder.status.setText(adu.getStatus());
    }

    @Override
    public int getItemCount() {
        return data.size();
    }


}
