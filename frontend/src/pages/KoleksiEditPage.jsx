import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import api from "../api/axios";

function KoleksiEditPage() {
    const { id } = useParams();
    const navigate = useNavigate();

    const [namaKoleksi, setNamaKoleksi] = useState("");
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        getKoleksi();
    }, []);

    const getKoleksi = async () => {
        try {
            const response = await api.get(`/koleksi/${id}`);

            setNamaKoleksi(response.data.data.nama_koleksi);
        } catch (error) {
            console.error(error);
            alert("Data koleksi tidak ditemukan.");

            navigate("/koleksi");
        } finally {
            setLoading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (namaKoleksi.trim() === "") {
            alert("Nama koleksi wajib diisi.");
            return;
        }

        try {
            await api.put(`/koleksi/${id}`, {
                nama_koleksi: namaKoleksi,
            });

            alert("Koleksi berhasil diperbarui.");

            navigate("/koleksi");
        } catch (error) {
            console.error(error);

            if (error.response?.status === 422) {
                alert("Validasi gagal.");
            } else {
                alert("Gagal memperbarui koleksi.");
            }
        }
    };

    if (loading) {
        return <h3>Loading...</h3>;
    }

    return (
        <div>
            <h2>Edit Koleksi</h2>

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
                                />
                            </td>
                        </tr>

                        <tr>
                            <td colSpan="3">
                                <button type="submit">
                                    Update
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

export default KoleksiEditPage;