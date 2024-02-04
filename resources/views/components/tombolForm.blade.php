<br>
<center>
    @if ($form == 'Detail')
        <a href="{{$linkKembali}}" class="btn btn-secondary btn-sm mb-1">Kembali</a>
    @else
        <button type="submit" class="btn btn-primary btn-sm mb-1">Simpan</button>
        <a href="{{$linkKembali}}" class="btn btn-secondary btn-sm mb-1">Kembali</a>
    @endif
</center>