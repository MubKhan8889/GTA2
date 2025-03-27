
import React, { useState, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select } from "@/components/ui/select";

const ApprenticeshipPage = ({ userRole, userName }) => {
    const [apprenticeships, setApprenticeships] = useState([]);
    const [selectedApprenticeship, setSelectedApprenticeship] = useState("");
    const [apprenticeName, setApprenticeName] = useState("");
    const [apprentices, setApprentices] = useState([]);

    // Fetch apprenticeships from the backend
    const fetchApprenticeships = async () => {
        const res = await fetch("/api/apprenticeships");
        const data = await res.json();
        setApprenticeships(data);
    };

    // Fetch apprentices from the backend (to assign apprenticeship)
    const fetchApprentices = async () => {
        const res = await fetch("/api/apprentices");
        const data = await res.json();
        setApprentices(data);
    };

    useEffect(() => {
        fetchApprenticeships();
        fetchApprentices();
    }, []);

    const handleAssign = async () => {
        if (!selectedApprenticeship || !apprenticeName) {
            alert("Please enter both apprentice name and select an apprenticeship.");
            return;
        }

        const apprenticeId = apprentices.find((apprentice) => apprentice.name === apprenticeName)?.apprentice_id;

        if (!apprenticeId) {
            alert("Apprentice not found.");
            return;
        }

        const response = await fetch("/api/assign", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                apprenticeId,
                apprenticeshipId: selectedApprenticeship,
            }),
        });

        const result = await response.json();
        alert(result.message);
        setSelectedApprenticeship("");
        setApprenticeName("");
    };

    return (
        <div className="flex">
            <div className="min-w-3/4 p-6">
                <div className="bg-white p-6 rounded-lg shadow-md">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Welcome, {userName || 'Apprentice'}
                    </h2>

                    {/* Assign Apprenticeship Section */}
                    {userRole === "admin" || userRole === "tutor" ? (
                        <>
                            <h3 className="font-bold mt-8 mb-2">Assign Apprenticeship</h3>
                            <div className="mb-4">
                                <Input
                                    type="text"
                                    placeholder="Apprentice Name"
                                    value={apprenticeName}
                                    onChange={e => setApprenticeName(e.target.value)}
                                    className="mb-2"
                                />
                                <Select
                                    value={selectedApprenticeship}
                                    onChange={e => setSelectedApprenticeship(e.target.value)}
                                    className="mb-2"
                                >
                                    <option value="">Select Apprenticeship</option>
                                    {apprenticeships.map(apprenticeship => (
                                        <option key={apprenticeship.apprenticeship_id} value={apprenticeship.apprenticeship_id}>
                                            {apprenticeship.name} ({apprenticeship.months} months)
                                        </option>
                                    ))}
                                </Select>
                                <Button onClick={handleAssign}>Assign Apprenticeship</Button>
                            </div>
                        </>
                    ) : null}
                </div>
            </div>
        </div>
    );
};

export default ApprenticeshipPage;
