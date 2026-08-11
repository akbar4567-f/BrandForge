import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";

function KoleksiCreatePage() {
    const navigate = useNavigate();

    const [namaKoleksi, setNamaKoleksi] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (namaKoleksi.trim() === "") {
            alert("Nama koleksi wajib diisi.");
            return;
        }

        try {
            await api.post("/koleksi", {
                nama_koleksi: namaKoleksi,
            });

            alert("Koleksi berhasil ditambahkan.");

            navigate("/koleksi");
        } catch (error) {
            console.error(error);

            if (error.response?.status === 422) {
                alert("Validasi gagal.");
            } else {
                alert("Gagal menyimpan koleksi.");
            }
        }
    };

    return (
        <div>
            <h2>Tambah Koleksi</h2>

            <form onSubmit={handleSubmit}>
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Koleksi</td>
                            <td>:</td>
                            <td>
                                <input
                                    type="text"
                                    value={namaKoleksi}
                                    onChange={(e) =>
                                        setNamaKoleksi(e.target.value)
                                    }
                                    placeholder="Masukkan Nama Koleksi"
                                />
                            </td>
                        </tr>

                        <tr>
                            <td colSpan="3">
                                <button type="submit">
                                    Simpan
                                </button>{" "}

                                <button
                                    type="button"
                                    onClick={() => navigate("/koleksi")}
                                >
                                    Kembali
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>  
    );
}

export default KoleksiCreatePage;