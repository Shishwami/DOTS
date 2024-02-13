const _RESET_TIME = 1000;

const DOTS_DOCUMENT = {
    NAME: 'DOTS_DOCUMENT',
    DOC_NUM: 'DOC_NUM',
    DOC_SUBJECT: 'DOC_SUBJECT',
    DOC_NOTES: 'DOC_NOTES',
    DOC_TYPE_ID: 'DOC_TYPE_ID',
    LETTER_DATE: 'LETTER_DATE',
    S_OFFICE_ID: 'S_OFFICE_ID',
    S_DEPT_ID: 'S_DEPT_ID',
    S_USER_ID: 'S_USER_ID',
    R_OFFICE_ID: 'R_OFFICE_ID',
    R_USER_ID: 'R_USER_ID',
    R_DEPT_ID: 'R_DEPT_ID',
    DATE_TIME_RECEIVED: 'DATE_TIME_RECEIVED',
    DOC_STATUS: 'DOC_STATUS',
};
const DOTS_DOC_LOGS = {
    NAME: 'DOTS_DOC_LOGS',
    DOC_NUM: 'DOC_NUM',
    ID: 'ID',
    DOC_LOCATION: 'DOC_LOCATION',
    DOC_OPERATION: 'DOC_OPERATION',
    DOC_ADDRESSEE: 'DOC_ADDRESSEE',
    DOC_STATUS: 'DOC_STATUS',
};
const DOTS_DOC_OFFICE = {
    NAME: 'DOTS_DOC_OFFICE',
    ID: 'ID',
    DOC_OFFICE: 'DOC_OFFICE',
};
const DOTS_DOC_ACTION = {
    NAME: 'DOTS_DOC_ACTION',
    ID: 'ID',
    DOC_ACTION: 'DOC_ACTION',
};
const DOTS_DOC_DEPT = {
    NAME: 'DOTS_DOC_DEPT',
    ID: 'ID',
    DOC_DEPT: 'DOC_DEPT',
};
const DOTS_DOC_TYPE = {
    NAME: 'DOTS_DOC_TYPE',
    ID: 'ID',
    DOC_TYPE: 'DOC_TYPE',
};
const DOTS_DOC_PRPS = {
    NAME: 'DOTS_DOC_PRPS',
    ID: 'ID',
    DOC_PRPS: 'DOC_PRPS',
};
const DOTS_DOC_STATUS = {
    NAME: 'DOTS_DOC_STATUS',
    ID: 'ID',
    DOC_STATUS: 'DOC_STATUS',
};
const DOTS_ACCOUNT_INFO = {
    NAME: 'DOTS_ACCOUNT_INFO',
    HRIS_ID: 'HRIS_ID',
    FULL_NAME: 'FULL_NAME',
    INITIAL: 'INITIAL',
    OFFICE_ID: 'OFFICE_ID',
    DEPT_ID: 'DEPT_ID',
    USERNAME: 'USERNAME',
    PASSWORD: 'PASSWORD',
    DIVISION: 'DIVISION',
}
const _REQUEST = {
    INSERT: 'INSERT',
    SELECT: 'SELECT',
    UPDATE: 'UPDATE',
    DELETE: 'DELETE',
    GET_DATE: 'GET_DATE',
    GET_DOC_NUM: 'GET_DOC_NUM',
    CREATE_SESSION: 'CREATE_SESSION',
    INSERT_DOCLOG: 'INSERT_DOCLOG',
    GET_SESSION_NAME: 'GET_SESSION_NAME',
    GET_SESSION_INITIAL: 'GET_SESSION_INITIAL',
    GET_SESSION_HRIS_ID: 'GET_SESSION_HRIS_ID',
    GET_SESSION_DEPT_ID: 'GET_SESSION_DEPT_ID',
}
const DOTS_DOCUMENT_SUB = {
    NAME: 'DOTS_DOCUMENT_SUB',
    DOC_NUM: 'DOC_NUM',
    ID: 'ID',
    PRPS_ID: 'PRPS_ID',
    DOC_NOTES: 'DOC_NOTES',
    S_USER_ID: 'S_USER_ID',
    S_DEPT_ID: 'S_DEPT_ID',
    R_USER_ID: 'R_USER_ID',
    R_DEPT_ID: 'R_DEPT_ID',
    ACTION_ID: 'ACTION_ID',
    DATE_TIME_RECEIVED: 'DATE_TIME_RECEIVED',
}
const _SUB_NAME = {

    // ID: "ID",

    // DOC_TYPE: 'Document Name',

    // DOC_PRPS: 'Purpose Name',

    // DOC_OFFICE: 'Office Name',

    // DOC_DIVISION: 'Division Name',

    // DOC_STATUS: 'Status',

    // DOC_NUM: 'No.',
    // DOC_SUBJECT: 'Subject',
    // DOC_TYPE: 'Document Type',
    // DOC_OFFICE: 'Document Office',
    // LETTER_DATE: 'Letter Date',
    // OFFICE_AGENCY: 'Office/Agency',
    // RECEIVED_BY: 'Received By',
    // DATE_TIME_RECEIVED: 'Date Received',
    // DOC_STATUS: "Status",

    // HRIS_ID: 'HRIS ID',
    // FULL: 'Fullname',
    // INITIAL: 'Initial',

    // DOC_PRPS: 'Purpose',
    // DOC_ADDRESSEE: 'Addressee',
    // DOC_NOTES: 'Notes',
    // DOC_ACTION: 'Action',
    // DOC_LOCATION: 'Location',
    // DOC_DIVISION: 'Division',
}
