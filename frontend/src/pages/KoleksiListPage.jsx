import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/axios";

function KoleksiListPage() {
    const [koleksi, setKoleksi] = useState([]);
    const navigate = useNavigate();

    useEffect(() => {
        getKoleksi();
    }, []);

    const getKoleksi = async () => {
        try {
            const response = await api.get("/koleksi");
            setKoleksi(response.data.data);
        } catch (error) {
            console.error(error);
            alert("Gagal mengambil data koleksi.");
        }
    };

    const handleEdit = (id) => {
        navigate(`/koleksi/edit/${id}`);
    };

    const handleDelete = async (id) => {
        const konfirmasi = window.confirm(
            "Yakin ingin menghapus koleksi ini?"
        );

        if (!konfirmasi) return;

        try {
            await api.delete(`/koleksi/${id}`);

            alert("Data berhasil dihapus.");

            getKoleksi();
        } catch (error) {
            console.error(error);
            alert("Gagal menghapus data.");
        }
    };

    return (
        <div className="container mt-5">

            <div className="d-flex justify-content-between align-items-center mb-4">
                <h2 className="fw-bold text-primary">
                    Daftar Koleksi
                </h2>

                <button
                    className="btn btn-primary"
                    onClick={() => navigate("/koleksi/create")}
                >
                    + Tambah Koleksi
                </button>
            </div>

            <div className="card shadow">

                <div className="card-body">

                    <table className="table table-striped table-hover align-middle">

                        <thead className="table-dark">

                            <tr className="text-center">
                                <th width="80">ID</th>
                                <th>Nama Koleksi</th>
                                <th width="180">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            {koleksi.length > 0 ? (

                                koleksi.map((item) => (

                                    <tr key={item.id_koleksi}>

                                        <td className="text-center">
                                            {item.id_koleksi}
                                        </td>

                                        <td>
                                            {item.nama_koleksi}
                                        </td>

                                        <td className="text-center">

                                            <button
                                                className="btn btn-warning btn-sm me-2"
                                                onClick={() =>
                                                    handleEdit(item.id_koleksi)
                                                }
                                            >
                                                Edit
                                            </button>

                                            <button
                                                className="btn btn-danger btn-sm"
                                                onClick={() =>
                                                    handleDelete(item.id_koleksi)
                                                }
                                            >
                                                Hapus
                                            </button>

                                        </td>

                                    </tr>

                                ))

                            ) : (

                                <tr>

                                    <td
                                        colSpan="3"
                                        className="text-center text-muted"
                                    >
                                        Belum ada data koleksi.
                                    </td>

                                </tr>

                            )}

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    );
}

export default KoleksiListPage;